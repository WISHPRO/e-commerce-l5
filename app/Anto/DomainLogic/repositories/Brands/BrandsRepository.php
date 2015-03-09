<?php namespace app\Anto\domainLogic\repositories;

use app\Models\Brand;

class BrandsRepository extends DataAccessRepository
{

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

    public function brands()
    {

        $data = $this->where('logo', '!=', 'null');


        return $data;
    }
}