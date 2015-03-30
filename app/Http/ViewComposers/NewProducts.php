<?php namespace app\http\ViewComposers;

use App\Antony\DomainLogic\Contracts\Caching\CacheInterface;
use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use App\Antony\DomainLogic\Modules\Product\ProductRepository;
use App\Models\Product;
use Illuminate\View\View;

class NewProducts extends ViewComposer
{

    /**
     * Product model
     *
     * @var ProductRepository
     */
    protected $model;

    /**
     * @param CacheInterface $cacheInterface
     * @param ProductRepository $repository
     */
    public function __construct(CacheInterface $cacheInterface, ProductRepository $repository)
    {
        $this->model = $repository;

        $this->cache = $cacheInterface;
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
        $key = hash('sha1', 'newProducts');

        if ($this->cache->has($key)) {
            $view->with('newProducts', $this->cache->get($key));

        } else {

            $data = $this->model->displayNewProducts();

            $this->cache->put($key, $data, 10);

            $view->with('newProducts', $data);
        }
    }
}