<?php namespace app\Anto\DomainLogic\interfaces;

interface CacheInterface {


    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key);


    /**
     * @param $key
     * @param $value
     * @param null $minutes
     *
     * @return mixed
     */
    public function put($key, $value, $minutes = null);


    /**
     * @param $key
     *
     * @return mixed
     */
    public function has($key);
}