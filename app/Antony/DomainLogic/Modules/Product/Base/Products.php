<?php namespace app\Antony\DomainLogic\Modules\Product\Base;

use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\Product\ProductRepository;

class Products extends DataAccessLayer
{

    protected $objectName = 'products';

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate(['categories', 'subcategories', 'brands']);
    }

    /**
     * @return mixed
     */
    public function getInventoryCount()
    {
        return $this->repository->where('quantity', '<>', '0')->get()->fetch('quantity')->sum();
    }

    /**
     * @return mixed
     */
    public function getAllProductsCount()
    {

        return $this->repository->all()->count();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function displayProductData($id)
    {

        return $this->repository->find($id, ['categories', 'subcategories', 'reviews.user', 'brands']);
    }

}