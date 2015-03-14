<?php namespace app\Anto\DomainLogic\repositories\Subcategory;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\SubCategory;

class SubcategoriesRepository extends DataAccessRepository
{

    public function __construct(SubCategory $subCategory)
    {
        $this->model = $subCategory;
    }
}