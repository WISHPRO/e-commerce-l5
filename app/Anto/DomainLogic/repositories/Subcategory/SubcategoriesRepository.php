<?php namespace app\Anto\DomainLogic\repositories\Subcategory;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\SubCategory;

class SubcategoriesRepository extends EloquentDataAccessRepository
{

    public function __construct(SubCategory $subCategory)
    {
        $this->model = $subCategory;
    }

    /**
     * @return mixed
     */
    public function displayFeaturedProducts()
    {

        $data = $this->with(['products.reviews', 'products.brands'])->where('name', 'like', 'laptop%')->get()->take(5)->random();

        return $data;
    }
}