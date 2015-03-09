<?php namespace app\http\ViewComposers;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
use app\Models\Product;
use app\Models\Review;
use Illuminate\View\View;

class TopProducts extends ViewComposer
{
    public $model = null;

    public function __construct(CacheInterface $cacheInterface, ProductRepository $repository)
    {

        $this->cache = $cacheInterface;

        $this->product = $repository;
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
        //        $data = $this->product->whereHas(['reviews', function ($q) {
//                $q->where('stars', '>=', config('site.reviews.hottest', 4));
//            }
//            , '>=', config('site.reviews.count', 10)

        $data = Product::whereHas(
            'reviews',
            // okay. logic here says that:
            // for a product to be 'hot', it must have been given at 4 stars by users,
            // at least 10 times. easy...right?
            function ($q) {
                $q->where('stars', '>=', config('site.reviews.hottest', 4));
            },
            '>=',
            config('site.reviews.count', 10)
        )->get();

        return $view->with('topProducts', $data);
    }
}