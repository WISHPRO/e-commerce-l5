<?php namespace app\Anto\Composers;

use app\Models\Product;
use app\Models\Review;

class TopProductsComposer extends ViewComposer
{

    protected $outputVariable = "topProducts";

    protected function fillComposer()
    {
        if (!$this->cachehasData()) {

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

            return $data;
        }

        return $this->retrieveCachedData();
    }
}