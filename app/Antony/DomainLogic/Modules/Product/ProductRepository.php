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
     * determine if a product has ran out of stock
     *
     * @return bool
     */
    public function hasRanOutOfStock()
    {
        return empty($this->model->quantity);
    }

    /**
     * @param $key
     * @param $operator
     * @param $value
     *
     * @return mixed
     */
    public function where($key, $operator, $value){

        return $this->model->where($key, $operator, $value);
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

        // add related category, subcategory and brands to DB
        $this->product->created(function ($product) use ($data) {

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

        return parent::add($data);
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
        $this->taxable = $this->model->getPrice(false) >= config('site.products.taxableThreshold');

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