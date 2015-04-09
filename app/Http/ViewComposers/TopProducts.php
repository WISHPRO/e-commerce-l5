<?php namespace app\http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use app\Antony\DomainLogic\Modules\Product\Base\Products;
use Illuminate\View\View;

class TopProducts extends ViewComposer
{

    /**
     * @param CacheInterface $cacheInterface
     * @param Products $repository
     */
    public function __construct(CacheInterface $cacheInterface, Products $repository)
    {

        $this->cache = $cacheInterface;

        $this->model = $repository;

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
        $key = h('topProducts');

        if ($this->cache->has($key)) {
            $view->with('topProducts', $this->cache->get($key));

        } else {

            $data = $this->model->displayTopRated();

            $this->cache->put($key, $data);

            $view->with('topProducts', $data);
        }
    }
}