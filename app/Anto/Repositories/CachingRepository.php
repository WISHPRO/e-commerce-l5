<?php
/**
 * Created by PhpStorm.
 * User: anto
 * Date: 2/24/15
 * Time: 9:27 PM
 */

namespace app\Anto\Repositories;


interface CachingRepository {

    /**
     * @return mixed
     */
    function cachingEnabled();

    /**
     * @param $data
     * @return mixed
     */
    function cacheData($data);

    /**
     * @return mixed
     */
    function retrieveCachedData();

    /**
     * @return mixed
     */
    function cachehasData();
}