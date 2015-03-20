<?php namespace app\Anto\domainLogic\contracts;

interface CookieRepositoryInterface
{

    /**
     * Get cookie data
     *
     * @return mixed
     */
    public function fetch();

    /**
     * Check if a cookie exists
     *
     * @return mixed
     */
    public function exists();

    /**
     * Create a cookie
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data);

    /**
     * Destroy a cookie
     *
     * @return mixed
     */
    public function destroy();

}