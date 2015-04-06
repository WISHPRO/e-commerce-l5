<?php namespace app\Antony\DomainLogic\Contracts\Account;

interface AccountsContract {

    /**
     * Constant representing a successful update of a users account information
     *
     * @var string
     */
    const ACCOUNT_INFO_UPDATED = 'userinfo.updated';

    /**
     * Constant representing an failed update of a users account info
     *
     * @var string
     */
    const UPDATE_FAILED = 'update.failed';

    /**
     * Constant representing a successful account deletion operation
     *
     * @var string
     */
    const ACCOUNT_DELETED = 'account.deleted';

    /**
     * Constant representing a successful forced account delete
     *
     * @var string
     */
    const ACCOUNT_DELETED_BY_FORCE = 'account.forced.delete';

    /**
     * Constant representing a failed account delete process
     *
     * @var string
     */
    const DELETE_ACCOUNT_FAILED = 'account.delete.failed';

    /**
     * Constant representing an invalid password attempt
     *
     * @var string
     */
    const INVALID_PASSWORD = 'account.invalid.password';

    /**
     * Constant representing a successful password update
     *
     * @var string
     */
    const PASSWORD_UPDATED = 'password.updated';

    /**
     * Constant representing status of a password hash matching with the one in storage
     *
     * @var string
     */
    const PASSWORD_MATCHES_OLD = 'password.same.as.old';

    /**
     * Constant representing an failed password update
     *
     * @var string
     */
    const PASSWORD_UPDATE_FAILED = 'password.update.failed';

    /**
     * Handles a redirect after an action has been done by the user
     *
     * @var string
     */
    public function handleRedirect($request);

    /**
     * Allows a user to delete their account, with an option to force it, if softDeletes are enabled
     *
     * @param bool $force
     *
     * @return mixed
     */
    public function deleteAccount($force = false);

    /**
     * Allows a user to update their account data
     *
     * @param $new_data
     *
     * @return mixed
     */
    public function updateAllData($new_data);
}