<?php namespace App\Antony\DomainLogic\Modules\Product;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Product;

class ProductRepository extends EloquentDataAccessRepository
{
    /**
     * The product sku
     *
     * @var string
     */
    protected $skuString = 'PCW';

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
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
    public function where($key, $operator, $value)
    {
        return $this->model->where($key, $operator, $value);
    }

    /**
     * Add a product to stock
     *
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
        $this->performSync($data);

        return parent::add($data);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return bool|int
     */
    public function update($data, $id)
    {
        $this->performSync($data);

        return parent::update($data, $id);
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
     * Adds product brands, categories and subcategories to the database
     *
     * @param $data
     *
     * @return void
     */
    private function performSync($data)
    {
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
    }

}