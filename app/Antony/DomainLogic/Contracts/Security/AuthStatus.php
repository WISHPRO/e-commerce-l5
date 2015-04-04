<?php namespace app\Antony\DomainLogic\Contracts\Security;

interface AuthStatus
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
     * Constant representing a successful registration email sent event
     *
     * @var string
     */
    const REGISTRATION_EMAIL_SENT = 'auth.confirmation.pending';

    /**
     * Constant representing a failed registration email sent event
     *
     * @var string
     */
    const REGISTRATION_EMAIL_NOT_SENT = 'auth.mail.not.sent';

    /**
     * Constant representing a successful account creation process
     *
     * @var string
     */
    const ACCOUNT_CREATED = 'account.created';

    /**
     * Constant representing an unsuccessful account creation process
     *
     * @var string
     */
    const ACCOUNT_NOT_CREATED = 'account.creation.failed';
}