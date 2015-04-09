<?php namespace app\Antony\DomainLogic\Contracts\Checkout;

interface GuestCheckoutContract
{

    CONST STEP = 1;

    CONST STEP_COMPLETED = 'step.complete';

    const STEP_INCOMPLETE = 'step.incomplete';

    const STEP_ALREADY_DONE = 'step.done';

    public function processGuestDetails($data);
}