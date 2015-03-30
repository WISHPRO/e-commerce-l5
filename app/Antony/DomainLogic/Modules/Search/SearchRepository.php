<?php namespace App\Antony\DomainLogic\Modules\Search;

use App\Antony\DomainLogic\Contracts\Search\SearchRepositoryInterface;

abstract class SearchRepository implements SearchRepositoryInterface
{

    /**
     * Search keywords
     *
     * @var string
     */
    protected $keywords = "";

    /**
     * pagination option
     *
     * @var boolean
     */
    protected $paginate = true;

    /**
     * Length of the paginated data set
     *
     * @var int
     */
    protected $paginationLength = 10;

    /**
     * The variable that will be output to the view
     *
     * @var string
     */
    protected $outputResultsVariableName = 'results';

    /**
     * Search results
     *
     * @var mixed
     */
    protected $results = null;

    /**
     * Search results view
     *
     * @var string
     */
    protected $resultsView;

    /**
     * Empty results message
     *
     * @var string
     */
    protected $emptyResultMessage = 'sorry. we could not find what you searched for';

    /**
     * Empty search results view
     *
     * @var string
     */
    protected $emptyResultsView = 'frontend.search.index';

    /**
     * @return null
     */
    function getResult()
    {
        return $this->results;
    }

}