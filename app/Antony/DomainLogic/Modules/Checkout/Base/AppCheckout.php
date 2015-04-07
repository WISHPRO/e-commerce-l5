<?php namespace app\Antony\DomainLogic\Modules\Checkout\Base;

use Illuminate\Contracts\Auth\Guard;

class AppCheckout
{

    /**
     * @var Guard
     */
    private $auth;

    public function __construct(Guard $auth)
    {

        $this->auth = $auth;
    }
}