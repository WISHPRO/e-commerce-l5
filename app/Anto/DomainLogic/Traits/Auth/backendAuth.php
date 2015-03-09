<?php namespace app\Anto\domainLogic\Traits\Auth;

use App\Http\Requests\UserRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use Redirect;

trait backendAuth
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('backend.Users.create');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Foundation\Http\FormRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(UserRequest $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request,
                $validator
            );
        }

        $this->registrar->create($request->all());

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

        return property_exists($this, 'redirectTo') ? $this->redirectTo
            : '/backend';
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('backend.Auth.login');
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

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            \Flash::message('Logged in successfully');

            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors(
                [
                    'email' => 'These credentials do not match our records.',
                ]
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
            : '/backend/login';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        flash('You were successfully logged out');

        return Redirect::route('backend.login');

    }
}