<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface PaymentDetailsContract
{

    CONST STEP = 3;

    public function processPaymentDetails($data);
}