<?php namespace app\Antony\DomainLogic\Modules\SubCategories\Base;

use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\SubCategories\SubcategoriesRepository;

class SubCategories extends DataAccessLayer
{

    protected $objectName = 'subcategories';

    /**
     * @param SubcategoriesRepository $subcategoriesRepository
     */
    public function __construct(SubcategoriesRepository $subcategoriesRepository)
    {
        parent::__construct($subcategoriesRepository);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate(['category']);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function retrieve($id)
    {
        return $this->repository->find($id, ['category']);
    }

    /**
     * @param $subcategory_id
     *
     * @return mixed
     */
    public function includeRelatedProducts($subcategory_id)
    {
        return $this->repository->with(['products.reviews'])->whereId($subcategory_id)->paginate(10);
    }
}