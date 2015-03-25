<?php namespace app\Anto\domainLogic\contracts;

interface SearchRepositoryInterface
{

    /**
     * Finds an item by keywords
     *
     * @return mixed
     */
    public function search($keywords);

    /**
     * Process the search result
     *
     * @param $result
     *
     * @return mixed
     */
    public function processResult($result);
}