<?php namespace App\Antony\DomainLogic\Modules\Authentication;

use App\Antony\DomainLogic\Modules\User\UserRepository;
use App\Events\PasswordResetWasRequested;
use App\Http\Requests\Security\resetPassword;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ResetPasswordsTrait
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
     * The user repository
     *
     * @var UserRepository
     */
    protected $user;

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
    public function postEmail(resetPassword $request)
    {
        // find the user by email
        $user = $this->user->getFirstBy('email', '=', $request->only('email'));

        if (is_null($user)) {

            if ($request->ajax()) {
                return response()->json(['message' => 'A user with that email address could not be found'], 404);
            } else {
                flash()->error('A user with that email address could not be found');

                return redirect()->back()->with('email', $request->get('email'));
            }

        } else {
            // fire the password reset event
            $result = event(new PasswordResetWasRequested($user));

            if ($request->ajax()) {
                return response()->json(['message' => 'Password reset instructions successfully sent to ' . $user->email]);
            } else {
                flash('Password reset instructions successfully sent to ' . $user->email);
                return redirect()->back();
            }
        }

    }


    /**
     * Display the password reset form for the given token
     *
     * @param $token
     *
     * @return $this
     */
    public function getReset($token)
    {
        if (is_null($token)) {

            throw new NotFoundHttpException('No token present in the current request');
        }
        return view('auth.reset')->with('token', $token);
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
                'token' => 'required',
                'email' => 'required',
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