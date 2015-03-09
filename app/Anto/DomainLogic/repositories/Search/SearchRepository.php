<?php namespace app\Anto\domainLogic\repositories\Search;

use app\Anto\domainLogic\interfaces\SearchRepositoryInterface;

abstract class SearchRepository implements SearchRepositoryInterface
{

    // query keywords
    protected $keywords = "";

    // defines if we should paginate the results
    protected $paginate = true;

    // length of the pagination set
    protected $paginationLength = 10;

    // output variable name, that will be used in the view
    protected $outputResultsVariableName = 'results';

    // results
    protected $results = null;

    // results view
    protected $resultsView = null;

    // self explanatory
    protected $emptyResultMessage = 'sorry. we could not find what you searched for';

    // self explanatory
    protected $emptyResultsView = 'frontend.search.index';

    /**
     * @return null
     */
    function getResult()
    {
        return $this->results;
    }

}