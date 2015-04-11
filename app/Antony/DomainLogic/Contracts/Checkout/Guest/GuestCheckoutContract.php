<?php namespace app\Antony\DomainLogic\Contracts\Checkout\Guest;

interface GuestCheckoutContract {

    /**
     * @return mixed
     */
    public function getCookieData();

    /**
     * @return mixed
     */
    public function retrieveGuestDetails();

    /**
     * @param $step_id
     * @param $data
     *
     * @return mixed
     */
    public function createGuestCheckoutCookie($step_id, $data);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function processCurrentStep($data);
}