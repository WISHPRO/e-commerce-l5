<?php namespace app\Anto\Traits\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Response;

trait ResetPasswords
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The password broker implementation.
     *
     * @var PasswordBroker
     */
    protected $passwords;

    /**
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function getEmail()
    {
        return view('auth.forgot_password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required']);

        $response = $this->passwords->sendResetLink(
            $request->only('email'),
            function ($m) {
                $m->subject($this->getEmailSubject());
            }
        );

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT: {
                \Session::put('email_address', $request->get('email'));

                return redirect()->back()->with('status', trans($response));
            }
            case PasswordBroker::INVALID_USER: {
                return redirect()->back()->withErrors(
                    ['email' => trans($response)]
                );
            }
            default: {
                flash()->error(
                    'The link you requested could not be sent. please try again later'
                );

                return redirect()->back()->withErrors(
                    ['email' => trans($response)]
                );
            }

        }
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject
            : 'Password reset instructions';
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     *
     * @return Response
     */
    public function getReset(Request $request)
    {
        if (is_null($request->get('token'))) {

            return view('errors.invalidToken');
        }

        return view('auth.reset')->with('token', $request->get('token'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function postReset(Request $request)
    {
        $this->validate(
            $request,
            [
                'token'    => 'required',
                'email'    => 'required',
                'password' => 'required|confirmed',
            ]
        );

        $credentials = $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );

        $response = $this->passwords->reset(
            $credentials,
            function ($user, $password) {
                $user->password = bcrypt($password);

                $user->save();

                $this->auth->login($user);
            }
        );

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET: {
                flash()->message('your password was reset successfully');

                return redirect($this->redirectPath());
            }
            case PasswordBroker::INVALID_TOKEN: {
                \Session::put('errorFatal', true);

                return redirect()->back();
            }
            default: {
                flash()->error(
                    'An error occurred when trying to reset your password. Please try again later'
                );

                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
            }
        }
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
            : '/';
    }
}