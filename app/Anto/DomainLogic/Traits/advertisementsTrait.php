<?php namespace app\Anto\DomainLogic\Traits;

use app\Models\Category;
use app\Models\Product;

trait advertisementsTrait
{

    /**
     * Categories model
     *
     * @var Category
     */
    protected $category;

    /**
     * Product model
     *
     * @var Product
     */
    protected $product;

    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->category->adverts->where('category_id', $this->category->id)->random();
    }
}