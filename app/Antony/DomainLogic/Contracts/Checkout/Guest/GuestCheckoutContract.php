<?php namespace app\Antony\DomainLogic\Contracts\Checkout\Guest;

interface GuestCheckoutContract
{

    /**
     * Retrieves data from the checkout cookie
     *
     * @return mixed
     */
    public function getCookieData($key = 'data');

    /**
     * Retrieves data about a guest user
     *
     * @return mixed
     */
    public function retrieveGuestDetails();

    /**
     * Creates the guest checkout cookie
     *
     * @param $step_id
     * @param $data
     *
     * @return mixed
     */
    public function createGuestCheckoutCookie($step_id, $data);

    /**
     * Process the current step in the checkout phase
     *
     * @param $data
     *
     * @return mixed
     */
    public function processCurrentStep($data);
}