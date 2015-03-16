<?php namespace app\Anto\domainLogic\Traits\Auth;

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

        $this->auth->login($this->registrar->create($request->all()));

        flash()->success('Welcome ' . beautify($request->get('first_name')) . '. Your account was successfully created');

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getActivate(Request $request)
    {
        if (!config('site.account.activation')) {

            // account activation disabled
            flash()->message('You will activate your account later. For now, just login');

            return redirect()->route('login');
        }

        if (is_null($request->get('code'))) {

            throw new NotFoundHttpException();
        }
        // activate a user's account
        $user = $this->user->whereConfirmationCode($request->get('code'))->first();

        if ($user == null) {
            throw new NotFoundHttpException('A user matching that confirmation code was not found');
        }
        $data = [
            'confirmed' => 1,
            'confirmation_code' => null,
        ];

        $user->modify($data);

        flash('Your account was successfully activated');

        // automatically log in the user
        $this->auth->login($user, true);

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

            // validate user credentials
            if ($this->auth->attempt($credentials, $request->has('remember'))) {

                return redirect()->intended($this->redirectPath());
            } else {
                flash()->error('Your account is not activated. You need to activate your account before you can use it');

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
        return property_exists($this, 'loginPath') ? $this->loginPath
            : '/account/login';
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
}