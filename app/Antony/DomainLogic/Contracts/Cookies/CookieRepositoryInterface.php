<?php namespace App\Antony\DomainLogic\Contracts\Cookies;

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
     * Queue a cookie to the next subsequent response
     *
     * @return mixed
     */

    public function queue();

    /**
     * Destroy a cookie
     *
     * @return mixed
     */
    public function destroy();

}