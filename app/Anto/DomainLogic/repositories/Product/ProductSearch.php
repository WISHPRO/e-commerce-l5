<?php namespace app\Anto\domainLogic\repositories\Product;

use app\Anto\domainLogic\repositories\Search\SearchRepository;
use app\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductSearch extends SearchRepository
{

    /**
     * Search keywords
     *
     * @var string
     */
    protected $keywords = '';

    /**
     * pagination option
     *
     * @var boolean
     */
    protected $paginate = true;

    /**
     * Search results view
     *
     * @var string
     */
    protected $resultsView = 'frontend.products.index';

    /**
     * Empty search results view
     *
     * @var string
     */
    protected $outputResultsVariableName = 'products';

    /**
     * Empty results message
     *
     * @var string
     */
    protected $emptyResultMessage = "sorry. we found no products matching";

    /**
     * Product model
     *
     * @var ProductRepository
     */
    protected $product;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->product = $repository;
    }

    /**
     * Integrates all search functionality into 1 function, by chaining them
     *
     * @return $this|\Illuminate\View\View
     */
    public function search($keywords)
    {
        // check if the query contains sth we can use as an SKU. our SKU looks like ...PCW123456789
        $sku = starts_with($keywords, 'PCW') ? $keywords : null;

        $this->keywords = $keywords;

        if (is_null($sku)) {
            // initialize normal search
            return $this->findProduct()->processResult($this->results);
        } else {
            // search by SKU
            return $this->searchBySku($sku)->processResult($this->results);
        }
    }

    /**
     * Process the search results
     *
     * @param $result
     *
     * @return $this|\Illuminate\View\View
     */
    public function processResult($result)
    {
        // no search results
        if (empty($this->getResult())) {
            flash($this->emptyResultMessage . " " . $this->keywords);

            return view($this->emptyResultsView);
        }

        // check if we have a paginated result set. This will imply that the result consisted
        // of more than 1 product
        if ($this->getResult() instanceof LengthAwarePaginator) {
            return view('frontend.Products.index')->with(
                $this->outputResultsVariableName,
                $this->results
            );
        }
        return view('frontend.Products.single')->with(
            $this->outputResultsVariableName,
            $this->results
        );

    }

    /**
     * Does the actual fetching of data, from the DB
     *
     * @return $this
     */
    public function findProduct()
    {
        // tried full text, it worked obviously,  but just decided to revert back to normal search
        // in both instances below, we search both the name, and description, in order to widen our results
        if ($this->paginate) {
            $this->results
                = $this->relations()
                ->where('name', 'LIKE', '%' . $this->keywords . '%')
                ->orWhere(
                    'description_long',
                    'LIKE',
                    '%' . $this->keywords . '%'
                )
                ->paginate($this->paginationLength);

            return $this;
        }

        $this->results
            = $this->relations()
            ->whereName($this->keywords)
            ->orWhere(
                'description_long',
                'LIKE',
                '%' . $this->keywords . '%'
            )
            ->get();

        return $this;

    }

    /**
     * Defines what relationships we shall include with the fetched data
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    function relations()
    {
        return $this->product->plus(['categories', 'subcategories', 'reviews']);
    }

    /**
     * Allows a user to search for a product by SKU
     *
     * @param $sku
     *
     * @return $this
     */
    function searchBySku($sku)
    {
        $this->results = $this->product->getFirstBy('sku', '=', $sku, ['categories', 'subcategories', 'reviews']);

        $this->outputResultsVariableName = 'product';

        // we only expect a single product, so we use the single products view
        $this->resultsView = 'frontend.products.single';

        return $this;
    }
}