<?php namespace App\Antony\DomainLogic\Modules\Brands;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Brand;

class BrandsRepository extends EloquentDataAccessRepository
{

    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        parent::__construct($brand);

    }
}