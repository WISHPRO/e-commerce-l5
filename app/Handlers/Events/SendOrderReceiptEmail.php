<?php namespace App\Handlers\Events;

use App\Events\OrderWasSubmitted;

use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendOrderReceiptEmail {

    /**
     * @var Mailer
     */
    private $mailer;

    /**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(Mailer $mailer)
	{
		//
        $this->mailer = $mailer;
    }

	/**
	 * Handle the event.
	 *
	 * @param  OrderWasSubmitted  $event
	 * @return void
	 */
	public function handle(OrderWasSubmitted $event)
	{
        $user = $event->user;

        $receiver = $event->recipient;
        $subject = "Checkout the ". beautify($event->product->name);

        $data = ['sender' => $user, 'product' => $event->product];

        $this->mailer->queue('emails.view-product', compact('data'), function ($m) use ($receiver, $subject) {
            $m->to($receiver);
            $m->subject($subject);
        });
	}

}
