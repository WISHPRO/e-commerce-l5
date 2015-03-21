<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\contracts\CacheInterface;
use app\Anto\domainLogic\repositories\BrandsRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Models\Brand;

class BrandsList extends ViewComposer
{
    protected $model;

    /**
     * @param CacheInterface $cacheInterface
     * @param BrandsRepository $repository
     */
    public function __construct(CacheInterface $cacheInterface, BrandsRepository $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;
    }


    /**
     * compose the view
     *
     * @param \Illuminate\View\View $view
     *
     * @return mixed
     */
    public function compose(\Illuminate\View\View $view)
    {
        $key = hash('sha1', 'brands');

        if ($this->cache->has($key)) {
            $view->with('brands', $this->cache->get($key));

        } else {

            $data = $this->model->displayBrands();

            $this->cache->put($key, $data, 10);

            $view->with('brands', $data);
        }

    }
}