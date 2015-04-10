<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface PaymentDetailsContract
{

    CONST STEP_ID = 3;

    CONST STEP_COMPLETED = 'step.complete';

    const STEP_INCOMPLETE = 'step.incomplete';

    const STEP_ALREADY_DONE = 'step.done';

    /**
     * @param $data
     *
     * @return mixed
     */
    public function processPaymentDetails($data);

    /**
     * If we have a payment service accessible via an API, we will probably implement it this way
     * @return mixed
     */
    public function callPaymentService();
}