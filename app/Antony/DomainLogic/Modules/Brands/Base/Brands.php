<?php namespace app\Antony\DomainLogic\Modules\Brands\Base;

use App\Antony\DomainLogic\Modules\Brands\BrandsRepository;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;

class Brands extends DataAccessLayer
{

    protected $objectName = 'brands';

    /**
     * @param BrandsRepository $brandsRepository
     */
    public function __construct(BrandsRepository $brandsRepository)
    {

        parent::__construct($brandsRepository);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate(['products']);
    }

    /**
     * @param $brand_id
     *
     * @return mixed
     */
    public function displayProductsWithBrands($brand_id)
    {
        return $this->repository->with(['products.categories', 'products.reviews', 'products.subcategories'])->where('id', $brand_id)->paginate(10);
    }
}