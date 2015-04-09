<?php namespace app\http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use app\Antony\DomainLogic\Modules\Product\Base\Products;
use Illuminate\View\View;

class NewProducts extends ViewComposer
{
    /**
     * @param CacheInterface $cacheInterface
     * @param Products $repository
     */
    public function __construct(CacheInterface $cacheInterface, Products $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;

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
        $key = h('newProducts');

        if ($this->cache->has($key)) {
            $view->with('newProducts', $this->cache->get($key));

        } else {

            $data = $this->model->displayNewProducts();

            $this->cache->put($key, $data);

            $view->with('newProducts', $data);
        }
    }
}