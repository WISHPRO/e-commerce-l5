<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
use app\Models\Product;
use Illuminate\View\View;

class NewProducts extends ViewComposer
{

    protected $model = null;

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
        $key = md5('newProducts');

        if ($this->cache->has($key)) {
            $view->with('newProducts', $this->cache->get($key));

        } else {

            $data = $this->model->products();

            $this->cache->put($key, $data, 10);

            $view->with('newProducts', $data);
        }
    }
}