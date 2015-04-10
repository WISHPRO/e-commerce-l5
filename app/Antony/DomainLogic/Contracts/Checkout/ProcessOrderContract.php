<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface ProcessOrderContract
{

    CONST STEP = 4;

    CONST STEP_COMPLETED = 'step.complete';

    const STEP_INCOMPLETE = 'step.incomplete';

    const STEP_ALREADY_DONE = 'step.done';

    /**
     * Process an order from a user
     *
     * @param $data
     *
     * @return mixed
     */
    public function processOrder($data);
}