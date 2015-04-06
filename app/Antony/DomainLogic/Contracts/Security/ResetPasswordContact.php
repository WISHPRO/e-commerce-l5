<?php namespace app\Antony\DomainLogic\Contracts\Security;

interface ResetPasswordContact
{

    /**
     * Constant representing a successfully sent reminder.
     *
     * @var string
     */
    const RESET_LINK_SENT = 'passwords.sent';

    /**
     * Constant representing a successfully reset password.
     *
     * @var string
     */
    const PASSWORD_RESET = 'passwords.reset';

    /**
     * Constant representing the user not found response.
     *
     * @var string
     */
    const INVALID_USER = 'passwords.user';

    /**
     * Constant representing an invalid password.
     *
     * @var string
     */
    const INVALID_PASSWORD = 'passwords.password';

    /**
     * Constant representing an invalid token.
     *
     * @var string
     */
    const INVALID_TOKEN = 'passwords.token';

    /**
     * Finds the user with the specified email address then sends the reset email
     *
     * @param $email_address
     *
     * @return mixed
     */
    public function getUserAndSendEmail($email_address);

    /**
     * Does the actual password reset stuff
     *
     * @param $request
     *
     * @return mixed
     */
    public function resetPassword($request);
}