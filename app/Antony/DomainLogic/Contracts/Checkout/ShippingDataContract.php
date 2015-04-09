<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface ShippingDataContract
{

    CONST STEP = 2;

    public function processShippingDetails($data);
}