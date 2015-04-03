<?php namespace App\Antony\DomainLogic\Modules\Product;

use App\Antony\DomainLogic\Modules\Search\SearchRepository;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class ProductSearch extends SearchRepository
{

    /**
     * pagination option
     *
     * @var boolean
     */
    public $paginate = true;
    /**
     * Defines if we should use AJAX
     *
     * @var boolean
     */
    public $useAJAX = false;
    /**
     * Search keywords
     *
     * @var string
     */
    protected $keywords = '';
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
     * @param $keywords
     *
     * @return $this|\Illuminate\View\View
     */
    public function search($keywords)
    {
        // check if the query contains sth we can use as an SKU. our SKU looks like ...PCW123456789
        $sku = starts_with($keywords, 'PCW') ? $keywords : null;

        $this->keywords = strtolower($keywords);

        if (is_null($sku)) {
            // initialize normal search
            if ($this->useAJAX) {
                return $this->findProduct($this->keywords);
            }
            return $this->findProduct($this->keywords)->processResult($this->results);
        } else {
            // search by SKU
            if ($this->useAJAX) {
                return $this->searchBySku($sku);
            }
            return $this->searchBySku($sku)->processResult($this->results);
        }
    }

    /**
     * Does the actual fetching of data, from the DB
     *
     * @return $this
     */
    public function findProduct($keywords)
    {
        // in both instances below, we search both the name, and description, in order to widen our results
        if ($this->paginate) {

            if ($this->useAJAX) {
                throw new InvalidArgumentException('Disable pagination first');
            }

            $this->results
                = $this->includeProductRelationships()->where('name', 'LIKE', '%' . $keywords . '%')
                ->orWhere('description_long', 'LIKE', '%' . $keywords . '%')
                ->paginate($this->paginationLength);

            return $this;
        }

        $this->results =
            $this->product->where('name', 'LIKE', '%' . $keywords . '%')
                ->orWhere('description_long', 'LIKE', '%' . $keywords . '%')
                ->get();

        return $this;

    }

    /**
     * Defines what relationships we shall include with the fetched data
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function includeProductRelationships()
    {
        return $this->product->with(['categories', 'subcategories', 'reviews']);
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

            return view('frontend.Products.index')->with($this->outputResultsVariableName, $this->results);
        }

        return view('frontend.Products.single')->with($this->outputResultsVariableName, $this->results);

    }

    /**
     * Allows a user to search for a product by SKU
     *
     * @param $sku
     *
     * @return $this
     */
    public function searchBySku($sku)
    {
        $this->outputResultsVariableName = 'product';
        // we only expect a single product, so we use the single products view
        $this->resultsView = 'frontend.products.single';

        $this->results = $this->product->getFirstBy('sku', '=', $sku, ['categories', 'subcategories', 'reviews']);

        return $this;
    }

    /**
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function processAJAXRequest()
    {
        // check if AJAX searching is turned on
        if ($this->useAJAX) {

            // we format the JSON returned to match the wonderful devbridge plugin used to provide auto-complete functionality
            $suggestions = [];

            // check if the results are a collection. No need to display suggestions for stuff like SKU search which is available
            if ($this->results instanceof Collection) {
                foreach ($this->results as $result) {
                    $suggestions[] = [
                        "value" => $result->name,
                        "data" => $result->id,
                        'redirect' => route('product.view', ['id' => $result->id, 'name' => preetify($result->name)]),
                    ];
                }
            }

            return response()->json(['suggestions' => $suggestions]);
        }

        return $this->results;
    }
}