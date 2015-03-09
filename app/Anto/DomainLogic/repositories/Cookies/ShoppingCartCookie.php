<?php namespace app\Anto\domainLogic\repositories\Cookies;


class ShoppingCartCookie extends ApplicationCookie
{

    public $name = 'shopping_cart';

    public $timespan = 3600;

}