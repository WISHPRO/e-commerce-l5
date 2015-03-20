<?php namespace app\Anto\domainLogic\contracts;

interface SearchRepositoryInterface
{

    /**
     * @return mixed
     */
    public function search($keywords);

    /**
     * @param $result
     *
     * @return mixed
     */
    public function processResult($result);
}