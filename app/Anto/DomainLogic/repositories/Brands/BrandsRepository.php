<?php namespace app\Anto\domainLogic\repositories;

use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Brand;

class BrandsRepository extends EloquentDataAccessRepository
{

    protected $image;

    public function __construct(Brand $brand, imageProcessor $image)
    {
        parent::__construct($brand);

        $this->image = $image;
    }

    public function image()
    {
        $this->image->init($this->model, 'logo');

        return $this->image->getImage();
    }

    public function brands()
    {
        $data = $this->where('logo', '<>', 'null');

        return $data;
    }
}