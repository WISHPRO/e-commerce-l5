<?php namespace app\Anto\domainLogic\repositories;

use app\Models\Brand;

class BrandsRepository extends EloquentDataAccessRepository
{

    protected $image;

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);

    }

    public function displayBrands()
    {
        $data = $this->where('logo', '<>', 'null');

        return $data;
    }
}