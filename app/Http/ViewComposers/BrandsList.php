<?php namespace app\http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use app\Antony\DomainLogic\Modules\Brands\Base\Brands;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use App\Models\Brand;
use Illuminate\View\View;

class BrandsList extends ViewComposer
{
    protected $model;

    /**
     * @param CacheInterface $cacheInterface
     * @param Brands $repository
     */
    public function __construct(CacheInterface $cacheInterface, Brands $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;

        $this->cache->setMinutes(config('site.composers.cache_duration', 10));
    }


    /**
     * Compose the view
     *
     * @param View $view
     *
     * @return mixed|void
     */
    public function compose(View $view)
    {
        $key = h('brands');

        if ($this->cache->has($key)) {
            $view->with('brands', $this->cache->get($key));

        } else {

            $data = $this->model->displayBrandsOnHomePage();

            $this->cache->put($key, $data);

            $view->with('brands', $data);
        }

    }
}