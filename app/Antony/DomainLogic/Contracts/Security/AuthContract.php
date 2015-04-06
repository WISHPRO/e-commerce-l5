<?php namespace app\Antony\DomainLogic\Contracts\Security;

interface AuthContract
{

    /**
     * Constant representing an successful authentication attempt
     *
     * @var string
     */
    const LOGIN_SUCCESS = 'auth.success';

    /**
     * Constant an account that isn't activated
     *
     * @var string
     */
    const NOT_ACTIVATED = 'account.not.activated';

    /**
     * Constant representing a failed login
     *
     * @var string
     */
    const LOGIN_FAILED = 'auth.invalid';

    /**
     * Constant representing an activated account
     *
     * @var string
     */
    const ACCOUNT_ACTIVATED = 'account.activated';

    /**
     * Allows a user to login to the app
     *
     * @param array $credentials
     *
     * @return mixed
     */
    public function login(array $credentials);

    /**
     * Allows us to check if an account has been confirmed
     *
     * @return mixed
     */
    public function checkIfAccountIsConfirmed();

    /**
     * Log out a user
     *
     * @return mixed
     */
    public function logout();

}