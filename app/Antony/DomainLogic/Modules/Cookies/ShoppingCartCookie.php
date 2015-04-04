<?php namespace app\Antony\DomainLogic\Modules\Cookies;

use App\Antony\DomainLogic\Modules\cookies\Base\ApplicationCookie;

class ShoppingCartCookie extends ApplicationCookie
{

    public $name = 'shopping_cart';

    public $timespan = 3600;
}