<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface GuestCheckoutContract
{

    CONST STEP_ID = 1;

    CONST STEP_COMPLETED = 'step.complete';

    const STEP_INCOMPLETE = 'step.incomplete';

    const STEP_ALREADY_DONE = 'step.done';

    /**
     * process Guest data
     *
     * @param $data
     *
     * @return mixed
     */
    public function processGuestDetails($data);
}