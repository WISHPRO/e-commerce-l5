<?php namespace app\Antony\DomainLogic\Contracts\Checkout\AuthenticatedUser;

interface AuthUserCheckoutContract
{

    /**
     * Retrieves the data associated with the cookie
     *
     * @return mixed
     */
    public function getCookieData($key = 'data');

    /**
     * Gets data about the authenticated user
     *
     * @return mixed
     */
    public function retrieveUserDetails();

    /**
     * Creates a user checkout cookie
     *
     * @param $step_id
     * @param $data
     *
     * @return mixed
     */
    public function createUserCheckoutCookie($step_id, $data);

    /**
     * process the current step in the checkout phase
     *
     * @param $data
     *
     * @return mixed
     */
    public function processCurrentStep($data);

}