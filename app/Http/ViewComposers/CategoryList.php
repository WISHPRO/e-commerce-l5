<?php namespace app\http\ViewComposers;


use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use app\Antony\DomainLogic\Modules\Categories\Base\Categories;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use App\Models\Category;
use Illuminate\View\View;

class CategoryList extends ViewComposer
{
    /**
     * @param CacheInterface $cacheInterface
     * @param Categories $categories
     */
    public function __construct(CacheInterface $cacheInterface, Categories $categories)
    {

        $this->cache = $cacheInterface;
        $this->model = $categories;

        $this->cache->setMinutes(config('site.composers.cache_duration', 10));
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
        $key = h('categories');

        if ($this->cache->has($key)) {
            $view->with('categories', $this->cache->get($key));

        } else {

            $data = $this->model->displayCategories();

            $this->cache->put($key, $data);

            $view->with('categories', $data);
        }
    }
}