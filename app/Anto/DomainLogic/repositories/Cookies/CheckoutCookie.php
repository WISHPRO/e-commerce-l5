<?php namespace app\Anto\DomainLogic\repositories\Cookies;

class CheckoutCookie extends ApplicationCookie
{

    public $name = 'checkout';

    public $timespan = 300;
}