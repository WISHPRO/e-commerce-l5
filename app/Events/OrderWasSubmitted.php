<?php namespace App\Events;

use App\Events\Event;

use app\Models\Order;
use Illuminate\Queue\SerializesModels;

class OrderWasSubmitted extends Event {

	use SerializesModels;

    /**
     * @var Order
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     */
	public function __construct(Order $order)
	{
		//
        $this->order = $order;
    }

}
