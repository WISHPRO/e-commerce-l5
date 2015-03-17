<?php namespace app\Anto\domainLogic\repositories;

use app\Models\Category;

class CategoriesRepository extends EloquentDataAccessRepository
{

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function categories()
    {
        $data = $this->plus(['subcategories'])->take(10)->orderBy('name', 'asc')->get();

        return $data;

    }
}