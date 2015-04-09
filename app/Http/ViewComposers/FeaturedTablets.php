<?php namespace app\Http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use app\Antony\DomainLogic\Modules\SubCategories\Base\SubCategories;
use Illuminate\View\View;

class FeaturedTablets extends ViewComposer
{

    /**
     * @param CacheInterface $cacheInterface
     * @param SubCategories $repository
     */
    public function __construct(CacheInterface $cacheInterface, Subcategories $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;

        $this->cache->setMinutes(config('site.composers.cache_duration', 10));
    }

    /**
     * Compose the View
     *
     * @param View $view
     *
     * @return mixed
     */
    function compose(View $view)
    {
        $key = h('featuredTablets');

        if ($this->cache->has($key)) {
            $view->with('featuredTablets', $this->cache->get($key));

        } else {

            $data = $this->model->displayFeaturedTablets();

            $this->cache->put($key, $data);

            $view->with('featuredTablets', $data);
        }
    }
}