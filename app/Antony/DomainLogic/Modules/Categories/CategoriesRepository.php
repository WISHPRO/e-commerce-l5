<?php namespace App\Antony\DomainLogic\Modules\Categories;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Category;

class CategoriesRepository extends EloquentDataAccessRepository
{
    /**
     * @var Category
     */
    private $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->category = $category;
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