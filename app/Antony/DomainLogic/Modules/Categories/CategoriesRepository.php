<?php namespace App\Antony\DomainLogic\Modules\Categories;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Category;

class CategoriesRepository extends EloquentDataAccessRepository
{
    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}