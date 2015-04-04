<?php namespace app\Antony\DomainLogic\Modules\Cookies;

use App\Antony\DomainLogic\Modules\cookies\Base\ApplicationCookie;

class CheckOutCookie extends ApplicationCookie
{

    public $name = 'checkout';

    public $timespan = 300;
}