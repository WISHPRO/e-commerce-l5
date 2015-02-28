<?php namespace app\Anto\Composers;

use app\Models\Category;

class CategoryListComposer extends ViewComposer
{

    protected $outputVariable = "categories";

    protected function fillComposer()
    {
        if (!$this->cachehasData()) {
            return Category::with('subcategories')->take(10)->orderBy(
                'name',
                'asc'
            )->get();
        } else {
            return $this->retrieveCachedData();
        }
    }
}