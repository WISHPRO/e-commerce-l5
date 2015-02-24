<?php namespace app\Anto\Composers;

use app\Models\Product;
use Carbon\Carbon;

class NewProductsComposer extends ViewComposer{

    protected $outputVariable = "newProducts";

    protected function fillComposer()
    {
        if(!$this->cachehasData()){
            return Product::where( 'created_at', '>=', new Carbon( 'last friday' ) )->get()->take(
                10
            );
        }
        return $this->retrieveCachedData();
    }
}