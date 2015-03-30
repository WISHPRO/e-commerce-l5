<?php namespace App\Antony\DomainLogic\Modules\Authentication;

use App\Events\UserWasRegistered;
use App\Models\User;
use Illuminate\Http\Request;

trait ClientAuthenticationTrait
{

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
        $this->validate($request, ['email' => 'required|email', 'password' => 'required',]);

        // user credentials
        $credentials = $request->only('email', 'password');

        // authenticate user
        if ($this->auth->attempt($credentials, $request->has('remember'))) {

            // auth passed. we check if their account is activated, only if we defined it in our site's config
            if (!config('site.account.login_when_inactive')) {

                // retrieve the authenticated user and check if their account is activated/confirmed
                if ($this->auth->user()->confirmed) {

                    // user's account is confirmed, so we redirect to their intended destination
                    return redirect()->intended($this->redirectPath());
                }
                // account is not confirmed
                flash('Your account has not been activated. You need to activate your account before using it');
                return redirect($this->loginPath())->withInput(
                    $request->only('email', 'remember')
                );
            }

            // authentication passed
            return redirect()->intended($this->redirectPath());

        } else {

            if ($request->ajax()) {
                return response()->json(['message' => 'Invalid email/password combination. Please try again, and check if you\'ve enabled caps lock'], 401);
            }

            flash()->error('Invalid email/password combination. Please try again, and check if you\'ve enabled caps lock');

            return redirect($this->loginPath())->withInput(
                $request->only('email', 'remember')
            );
        }
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
}