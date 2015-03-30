<?php namespace App\Antony\DomainLogic\Modules\Product;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Product;
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
     * @var Product
     */
    private $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->product = $product;
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
        // create product SKU
        $this->model->creating(function ($product) {
            $product->sku = $this->generateProductSKU();
        });

        $product = parent::add($data);

        // add related category, subcategory and brands to DB
        $this->model->saved(function ($product) use ($data) {

            $catID = array_get($data, 'category_id');
            $subCatID = array_get($data, 'sub_category_id');
            $brandID = array_get($data, 'brand_id');
            $productID = $product->id;

            // perform sync
            $product->categories()->sync([$catID], [$productID]);

            $product->brands()->sync([$brandID], [$productID]);

            // since subcategory_id is not a requirement, we may skip it if its not available
            if (!empty($subCatID)) {
                $product->subcategories()->sync([$subCatID], [$productID]);
            }
        });

        return $product;
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
     * Display new products on the home page
     *
     * @return mixed
     */
    public function displayNewProducts()
    {
        $data = $this->with(['reviews', 'brands'])->where('created_at', '>=', new Carbon('last friday'))->get()->take(10);

        return $data;
    }


}