<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface ProcessOrderContract
{

    CONST STEP = 4;

    public function processOrder($data);
}