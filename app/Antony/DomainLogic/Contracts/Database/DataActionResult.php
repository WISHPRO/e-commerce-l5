<?php namespace app\Antony\DomainLogic\Contracts\Database;

interface DataActionResult
{

    /**
     * Constant representing a successful save operation
     *
     * @var string
     */
    CONST CREATE_SUCCESS = 'creation.succeeded';

    /**
     * Constant representing an unsuccessful save operation
     *
     * @var string
     */
    CONST CREATE_FAILED = 'creation.failed';

    /**
     * Constant representing a successful update operation
     *
     * @var string
     */
    CONST UPDATE_SUCCEEDED = 'update.success';

    /**
     * Constant representing an unsuccessful update operation
     *
     * @var string
     */
    CONST UPDATE_FAILED = 'update.failed';

    /**
     * Constant representing a successful delete operation
     *
     * @var string
     */
    CONST DELETE_SUCCESS = 'delete.success';

    /**
     * Constant representing an unsuccessful delete operation
     *
     * @var string
     */
    CONST DELETE_FAILED = 'delete.failed';

    /**
     * Constant representing an auth hitch. error code 401
     *
     * @var string
     */
    CONST ACCESS_DENIED = 'access.denied';

    /**
     * Handle a redirect after a CRUD operation
     *
     * @param $request
     *
     * @return mixed
     */
    public function handleRedirect($request);
}