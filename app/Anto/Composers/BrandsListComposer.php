<?php namespace app\Anto\Composers;

use app\Models\Brand;

class BrandsListComposer extends ViewComposer {

    protected $outputVariable = "brands";

    protected function fillComposer()
    {
        if(!$this->cachehasData()){
            return Brand::with( 'products' )->whereNotNull( 'logo' )->take( 7 )->orderBy(
                'name',
                'asc'
            )->get();
        }
        return $this->retrieveCachedData();
    }
}