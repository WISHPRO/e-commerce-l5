<?php namespace app\Antony\DomainLogic\Modules\Authentication;

use app\Antony\DomainLogic\Contracts\Security\resetPasswordStatus;
use app\Antony\DomainLogic\Modules\Authentication\Base\ApplicationAuthProvider;
use App\Events\PasswordResetWasRequested;
use App\Models\User;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ResetPasswords extends ApplicationAuthProvider implements resetPasswordStatus
{

    /**
     * password reset status
     *
     * @var string
     */
    private $status;

    /**
     * Results after sending mail
     *
     * @var array
     */
    private $mailResult;


    /**
     * The user
     *
     * @var User
     */
    private $user;

    /**
     * Finds a user by their email
     *
     * @param $email_address
     *
     * @return $this
     */
    public function getUserAndSendEmail($email_address)
    {
        $this->user = $this->userRepository->getFirstBy('email', '=', $email_address);

        if (is_null($this->user)) {
            $this->status = resetPasswordStatus::INVALID_USER;

            return $this;

        } else {
            // send mail
            $this->sendResetEmail();

            $this->status = resetPasswordStatus::RESET_LINK_SENT;
            return $this;
        }

    }

    /**
     * Triggers the event that sends a reset email to the user
     *
     * @return $this
     */
    protected function sendResetEmail()
    {
        // trigger the mail send event
        $this->mailResult = event(new PasswordResetWasRequested($this->user));

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSendEmailResult()
    {
        return $this->mailResult;
    }

    /**
     * Handle an email send/fail redirect
     *
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleEmailSentRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        switch ($this->status) {
            case resetPasswordStatus::INVALID_USER: {

                if ($request->ajax()) {
                    return response()->json(['message' => 'A user with that email address could not be found'], 404);
                } else {
                    flash()->error('A user with that email address could not be found');

                    return redirect()->back()->with('email', $request->get('email'));
                }
            }
            case resetPasswordStatus::RESET_LINK_SENT: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Password reset instructions successfully sent to ' . $this->user->email]);
                } else {
                    flash('Password reset instructions successfully sent to ' . $this->user->email);
                    return redirect()->back();
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Process a password reset request. This is the last step in the reset process
     *
     * @param $request
     *
     * @return $this
     */
    public function resetPassword($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }

        $credentials = $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );

        $this->status = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);

            $user->save();

            $this->auth->login($user);
        });

        return $this;

    }

    /**
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        if (is_null($this->status)) {
            throw new InvalidArgumentException('You need to try and attempt to find the user and send them a reset email');
        }
        switch ($this->status) {
            case resetPasswordStatus::PASSWORD_RESET: {
                flash()->message('your password was reset successfully');

                return redirect($this->redirectPath());
            }
            case resetPasswordStatus::INVALID_TOKEN: {

                session(['errorFatal' => true]);

                return redirect()->back();
            }
            default: {
                flash()->error('An error occurred when trying to reset your password. Please try again later');

                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($this->status)]);
            }
        }
    }
}