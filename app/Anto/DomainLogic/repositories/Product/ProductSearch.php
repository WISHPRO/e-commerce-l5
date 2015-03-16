<?php namespace app\Anto\domainLogic\repositories\Product;

use app\Anto\domainLogic\repositories\Search\SearchRepository;
use app\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductSearch extends SearchRepository
{

    protected $keywords = '';

    protected $paginate = true;

    protected $resultsView = 'frontend.products.index';

    protected $outputResultsVariableName = 'products';

    protected $emptyResultMessage = "sorry. we found no products matching";

    private $product = null;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->product = $repository;
    }

    /**
     * Integrates all search functionality into 1
     *
     * @return $this|\Illuminate\View\View
     */
    public function search($keywords)
    {
        // check if the query contains sth we can use as an SKU. our SKU looks like ...PCW123456789
        $sku = starts_with($this->keywords, 'PCW') ? $keywords : null;

        if ($sku == null) {
            $this->keywords = $keywords;
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
        if (empty($this->getResult())) {
            flash($this->emptyResultMessage . " " . $this->keywords);

            return view($this->emptyResultsView);
        }

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

        $this->resultsView = 'frontend.products.single';

        return $this;
    }
}