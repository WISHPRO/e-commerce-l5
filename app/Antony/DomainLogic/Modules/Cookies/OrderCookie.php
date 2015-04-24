<?php namespace app\Antony\DomainLogic\Modules\Cookies;

use App\Antony\DomainLogic\Modules\cookies\Base\ApplicationCookie;

class OrderCookie extends ApplicationCookie
{

    public $name = '_od';

    public $timespan = 300;
}