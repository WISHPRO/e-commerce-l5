<?php namespace app\Anto\DomainLogic\repositories\Subcategory;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\SubCategory;

class SubcategoriesRepository extends EloquentDataAccessRepository
{

    public function __construct(SubCategory $subCategory)
    {
        $this->model = $subCategory;
    }
}