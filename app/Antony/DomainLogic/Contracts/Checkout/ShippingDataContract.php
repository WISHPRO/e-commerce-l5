<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface ShippingDataContract
{

    CONST STEP_ID = 2;

    CONST STEP_COMPLETED = 'step.complete';

    const STEP_INCOMPLETE = 'step.incomplete';

    const STEP_ALREADY_DONE = 'step.done';

    /**
     * Process a user's shipping data
     *
     * @param $data
     *
     * @return mixed
     */
    public function processShippingDetails($data);
}