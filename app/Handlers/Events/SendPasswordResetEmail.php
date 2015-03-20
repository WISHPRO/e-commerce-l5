<?php namespace App\Handlers\Events;

use App\Events\PasswordResetWasRequested;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordResetEmail
{

    use InteractsWithQueue;

    protected $mailer;

    protected $user;

    protected $tokens;

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct(Mailer $mailer, TokenRepositoryInterface $tokens, UserProvider $users)
    {
        $this->mailer = $mailer;

        $this->tokens = $tokens;

        $this->user = $users;
    }

    /**
     * Handle the event.
     *
     * @param  PasswordResetWasRequested $event
     *
     * @return void
     */
    public function handle(PasswordResetWasRequested $event)
    {
        $this->sendResetEmail($event->email);
    }

    /**
     * @param $recipient
     *
     * @return mixed
     */
    public function sendResetEmail($recipient)
    {

        $user = $this->getUser($recipient);

        $subject = $this->subject();

        if (is_null($user)) {
            return NULL;
        }

        $token = $this->tokens->create($user);

        return $this->mailer->queue('emails.password', compact('token', 'user'), function ($m) use ($recipient, $subject) {
            $m->to($recipient);

            $m->subject($subject);

        });
    }

    /**
     * @return string
     */
    public function subject()
    {

        return "Password reset information";
    }
}
