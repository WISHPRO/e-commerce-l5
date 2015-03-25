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
     * Displays categories on the navigation bar
     *
     * @return mixed
     */
    public function displayCategories()
    {
        $data = $this->with(['subcategories'])->take(5)->orderBy('name', 'asc')->get();

        return $data;
    }
}