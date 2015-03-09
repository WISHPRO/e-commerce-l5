<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\CategoriesRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Models\Category;
use Illuminate\View\View;

class CategoryList extends ViewComposer
{
    protected $model = null;

    public function __construct(CacheInterface $cacheInterface, CategoriesRepository $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;
    }

    /**
     * compose the view
     *
     * @param View $view
     *
     * @return mixed
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->model->categories());
    }
}