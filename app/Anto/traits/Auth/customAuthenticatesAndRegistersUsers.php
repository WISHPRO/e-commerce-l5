<?php
/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/16/2015
 * Time: 3:26 PM
 */

namespace app\Anto\Traits\Auth;


use App\Http\Requests\UserFormRequest;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;

trait customAuthenticatesAndRegistersUsers {

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
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Foundation\Http\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(UserFormRequest $request)
    {

        $this->auth->login($this->registrar->create($request->all()));

        return redirect($this->redirectPath());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();
        \Flash::message('You successfully logged out');
        return redirect('/');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath'))
        {
            return $this->redirectPath;
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
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
}