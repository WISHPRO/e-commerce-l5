<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\BrandsRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Models\Brand;
use View;

class BrandsList extends ViewComposer
{
    protected $model = null;

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
        $view->with('brands', $this->model->brands());
    }
}