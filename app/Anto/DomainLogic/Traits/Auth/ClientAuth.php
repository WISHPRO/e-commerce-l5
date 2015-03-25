<?php namespace app\Anto\domainLogic\Traits\Auth;

use App\Events\UserWasRegistered;
use App\Models\User;
use App\Services\Registrar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ClientAuth
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * User repository implementation
     *
     * @var User
     */
    protected $user;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request,
                $validator
            );
        }

        $user = $this->registrar->create($request->all());

        // send registration email
        $response = event(new UserWasRegistered($user));

        flash()->overlay('Your account was successfully created. Check your email address for an activation email');

        return redirect($this->redirectPath());
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
     * Activate a user's account
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getActivate($code)
    {

        if (!config('site.account.activation')) {

            // account activation disabled
            flash()->message('You will activate your account later. For now, just login');

            return redirect()->route('login');
        }

        if (is_null($code)) {

            throw new NotFoundHttpException();
        }

        return $this->activate($code);
    }

    /**
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($code)
    {
        // activate a user's account
        $user = $this->verifyCode($code);

        flash()->overlay('Your account was successfully activated. You are now a member at PC-World!');

        // auto login the user. Save them some clicks
        $this->auth->login($user);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        // check if users are allowed to login, without activating their accounts
        if (!config('site.account.login_when_inactive')) {

            $credentials = array_add($request->only('email', 'password'), 'confirmed', 1);

            // check if user's account is activated
            if ($this->auth->attempt($credentials, $request->has('remember'))) {

                return redirect()->intended($this->redirectPath());
            } else {
                flash()->error('Your account is not activated. You need to activate your account before using it');

                return redirect($this->loginPath())
                    ->withInput(
                        $request->only('email', 'remember')
                    );
            }

        } else {

            $credentials = $request->only('email', 'password');
        }

        // validate user credentials
        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        flash()->error('Login failed. Enter valid credentials');

        return redirect($this->loginPath())
            ->withInput(
                $request->only('email', 'remember')
            );
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/account/login';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }

    /**
     * Verify an activation code
     *
     * @param $code
     *
     * @return mixed
     */
    public function verifyCode($code)
    {
        // verify that this confirmation code matches the user
        $user = $this->user->where('confirmation_code', '=', $code)->first();

        if ($user == null) {

            throw new NotFoundHttpException('A user matching that confirmation code was not found');
        }

        // update necessary fields and save the user model
        $user->confirmation_code = null;

        $user->confirmed = true;

        $user->save();

        return $user;
    }

}