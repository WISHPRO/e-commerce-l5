<?php namespace app\Antony\DomainLogic\Contracts\Security;

interface UserRegistrationContract
{

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

    /**
     * Sends registration email to a registered user on first time of asking
     *
     * @return mixed
     */
    public function sendRegistrationEmail();

    /**
     * Registers a user
     *
     * @param array $data
     *
     * @return mixed
     */
    public function register(array $data);

    /**
     * Activates a user account
     *
     * @param $code
     *
     * @return mixed
     */
    public function activate($code);

    /**
     * Verifies that the code we sent via email is associated with that email
     *
     * @param $code
     *
     * @return mixed
     */
    public function verifyCode($code);
}