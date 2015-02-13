<?php

use App\Http\Controllers\Controller;

class BackendAuthController extends Controller
{
    /**
     * process an admin's login request
     * GET /auth
     *
     * @return Response
     */
    public function login()
    {
        // if a user is already logged in, just redirect them back to the page they made the request from
        if (Auth::check()) {
            return Redirect::route('backend')->with('message', 'You are already logged in')->with('alertclass', 'alert-info');
        }
        // otherwise, just launch the login view
        return View::make('backend.auth.login');
    }

    /**
     * validates the login request
     * POST /auth
     *
     * @return Response
     */
    public function postLogin()
    {
        return $this->doLogin();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function doLogin()
    {
        $user = new User();
        // failed validation
        if (!$user->validate(User::$sign_in_rules)) {

            return Redirect::back()->withErrors($user->errors())->withInput()->with('message', "The following errors occured")->with('alertclass', 'alert-danger');
        }

        $email_address = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('remember') === 'remember';

        // attempt to login the user using specified credentials

        if (Auth::attempt(['email' => $email_address, 'password' => $password], $remember)) {
            // success. redirect to intended destination
            return Redirect::route('backend')->with('message', 'successfully logged in')->with('alertclass', 'alert-success');
        } else {
            /* check the fail count here. to be implemented later */

            // fail. redirect to login page
            return Redirect::back()->with('message', 'Invalid email/password combination')->withInput()->with('alertclass', 'alert-danger');
        }
    }


    // Allow the admin to safely logout
    public function Logout()
    {
        Auth::logout();
        // successful logout
        return Redirect::route('backend.login')->with('message', 'successfully logged out')->with('alertclass', 'alert-success');

    }

}