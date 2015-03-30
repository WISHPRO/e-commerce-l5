<?php namespace App\Antony\DomainLogic\Contracts\Search;

interface SearchRepositoryInterface
{

    /**
     * Finds an item by keywords
     *
     * @param $keywords
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