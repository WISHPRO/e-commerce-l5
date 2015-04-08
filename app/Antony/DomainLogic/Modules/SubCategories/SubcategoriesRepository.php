<?php namespace App\Antony\DomainLogic\Modules\SubCategories;

use App\Antony\DomainLogic\modules\DAL\EloquentDataAccessRepository;
use App\Models\SubCategory;

class SubcategoriesRepository extends EloquentDataAccessRepository
{

    /**
     * @param SubCategory $subCategory
     */
    public function __construct(SubCategory $subCategory)
    {
        $this->model = $subCategory;
    }

    /**
     * @return mixed
     */
    public function displayFeaturedLaptops()
    {

        $data = $this->with(['products.reviews', 'products.brands'])->where('name', 'like', 'laptop%')->get()->take(5)->random();

        return $data;
    }

    /**
     * @return mixed
     */
    public function displayFeaturedTablets()
    {
        $data = $this->with(['products.reviews', 'products.brands'])->where('name', 'like', 'tablets%')->get()->take(5)->random();

        return $data;
    }
}