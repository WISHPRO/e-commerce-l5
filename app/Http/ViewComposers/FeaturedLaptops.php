<?php namespace app\Http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use App\Antony\DomainLogic\Modules\SubCategories\SubcategoriesRepository;
use Illuminate\View\View;

class FeaturedLaptops extends ViewComposer
{

    protected $model;

    /**
     * @param CacheInterface $cacheInterface
     */
    public function __construct(CacheInterface $cacheInterface, SubcategoriesRepository $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;
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
        $key = hash('sha1', 'featuredLaptops');

        if ($this->cache->has($key)) {
            $view->with('featuredLaptops', $this->cache->get($key));

        } else {

            $data = $this->model->displayFeaturedLaptops();

            $this->cache->put($key, $data, 10);

            $view->with('featuredLaptops', $data);
        }
    }
}