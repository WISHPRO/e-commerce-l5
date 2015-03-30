<?php namespace App\Antony\DomainLogic\Modules\Brands;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Brand;

class BrandsRepository extends EloquentDataAccessRepository
{

    /**
     * @var Brand
     */
    private $brand;

    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        parent::__construct($brand);

        $this->brand = $brand;
    }

    public function displayBrands()
    {
        $data = $this->where('logo', '<>', 'null');

        return $data;
    }
}