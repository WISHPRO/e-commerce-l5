<?php namespace app\Anto\domainLogic\repositories;

use app\Models\Category;

class CategoriesRepository extends EloquentDataAccessRepository
{

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    /**
     * @return mixed
     */
    public function categories()
    {
        $data = $this->plus(['subcategories', 'adverts'])->take(10)->orderBy('name', 'asc')->get();

        return $data;

    }
}