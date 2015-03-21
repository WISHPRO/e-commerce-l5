<?php namespace app\Anto\DomainLogic\repositories\Product;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\Product;
use Carbon\Carbon;

class ProductRepository extends EloquentDataAccessRepository
{

    /**
     * The product sku
     *
     * @var string
     */
    protected $skuString = 'PCW';

    /**
     * Tax status for this product
     *
     * @var boolean
     */
    private $taxable = true;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * Generate a sample product SKU
     *
     * @return string
     */
    public function generateProductSKU()
    {
        return $this->skuString . int_random();
    }

    /**
     * @return string
     */
    public function name()
    {
        return beautify($this->model->name);
    }

    /**
     * Determines if a product is new
     *
     * @return bool
     */
    public function isNew()
    {
        $byWhen = new Carbon('last friday');

        return $this->model->created_at >= $byWhen;
    }

    /**
     * Allows us to check if a product has a discount
     *
     * @return bool
     */
    public function hasDiscount()
    {
        return !empty($this->model->discount);
    }

    /**
     * determine if a product has ran out of stock
     *
     * @return bool
     */
    public function hasRanOutOfStock()
    {
        return empty($this->model->quantity);
    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {

        $data = array_add($data, 'id', int_random());

        $result = parent::add($data);

        if (empty($result)) {
            return null;
        }

        return $result;
    }

    /**
     * Determines if a product is taxable
     *
     * @return bool
     */
    public function isTaxable()
    {
        $this->taxable = $this->model->price >= config('site.products.taxableThreshold');

        return $this->taxable;
    }

    /**
     * @return mixed
     */
    public function displayNewProducts()
    {
        $data = $this->with(['reviews'])->where('created_at', '>=', new Carbon('last friday'))->get()->take(10);

        return $data;
    }

}