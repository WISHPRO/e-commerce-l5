<?php namespace app\Anto\DomainLogic\repositories\Product;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\Product;
use Carbon\Carbon;

class ProductRepository extends DataAccessRepository
{

    private $taxable = true;

    protected $skuString = 'PCW';

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
     * Determines if a product is taxable
     *
     * @return bool
     */
    public function isTaxable()
    {
        $this->taxable = $this->model->price >= config('site.products.taxableThreshold');

        return $this->taxable;
    }

    public function products()
    {
        $data = $this->where('created_at', '>=', new Carbon('last friday'))->take(10);

        return $data;
    }

}