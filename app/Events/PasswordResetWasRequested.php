<?php namespace App\Events;

use App\Events\Event;

use app\Models\User;
use Illuminate\Queue\SerializesModels;

class PasswordResetWasRequested extends Event {

	use SerializesModels;

    public $email;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($email)
	{
		$this->email = $email;
	}

}
