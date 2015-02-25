<?php namespace app\Anto\Composers;

use app\Models\Product;

class TopProductsComposer extends ViewComposer{

    protected $outputVariable = "topProducts";

    protected function fillComposer()
    {
        if(!$this->cachehasData())
        {
            return Product::with(
                [
                    'reviews' => function ( $query ) {
                        $query->where( 'stars', '>=', '4' )->orderBy( 'stars', 'asc' );

                    }
                ]
            )->get()->take( 10 );
        }
        return $this->retrieveCachedData();
    }
}