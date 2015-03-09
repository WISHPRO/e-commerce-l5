<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
use app\Models\Product;
use Carbon\Carbon;
use Illuminate\View\View;

class NewProducts extends ViewComposer
{

    protected $model = null;

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
        $view->with('newProducts', $this->model->products());
    }
}