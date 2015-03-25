<?php namespace app\Http\ViewComposers;

use app\Anto\DomainLogic\contracts\CacheInterface;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Anto\DomainLogic\repositories\Subcategory\SubcategoriesRepository;
use Illuminate\View\View;

class FeaturedLaptopsAndTablets extends ViewComposer
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
        $key = hash('sha1', 'featured');

        if ($this->cache->has($key)) {
            $view->with('featured', $this->cache->get($key));

        } else {

            $data = $this->model->displayFeaturedProducts();

            $this->cache->put($key, $data, 10);

            $view->with('featured', $data);
        }
    }
}