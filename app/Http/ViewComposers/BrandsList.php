<?php namespace app\http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Brands\BrandsRepository;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use App\Models\Brand;
use Illuminate\View\View;

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


    public function compose(View $view)
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