<?php namespace app\Anto\Observers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\User;
use Illuminate\Mail\Mailer;

class UserObserver
{

    protected $mail;

    protected $image;

    public function __construct(Mailer $mailer, imageProcessor $imageProcessor)
    {
        $this->mail = $mailer;

        $this->image = $imageProcessor;
    }

    public function saving(User $model)
    {
        // $model->county()->associate($model);
    }

    public function saved(User $model)
    {
        // send an account activation email
        $this->mail->queue('email.verify', ['user' => $model], function ($message) use (&$model) {
            $message->to($model->email, $model->getUserName())
                ->subject($this->getSubject());
        });
    }

    public function getSubject()
    {
        return 'Account activation';
    }

}