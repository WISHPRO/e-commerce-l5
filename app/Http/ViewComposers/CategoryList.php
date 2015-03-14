<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\CategoriesRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Models\Category;
use Illuminate\View\View;

class CategoryList extends ViewComposer
{

    protected $model = null;

    /**
     * @param CacheInterface $cacheInterface
     * @param CategoriesRepository $repository
     */
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
        $key = md5('categories');

        if ($this->cache->has($key))
        {
            $view->with('categories', $this->cache->get($key));

        } else {

            $data = $this->model->categories();

            $this->cache->put($key, $data, 10);

            $view->with('categories', $data);
        }
    }
}