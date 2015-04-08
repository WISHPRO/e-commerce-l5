<?php namespace app\Antony\DomainLogic\Modules\SubCategories\Base;

use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\SubCategories\SubcategoriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
     * @param Request $request
     *
     * @return mixed
     */
    public function includeRelatedProducts($subcategory_id, Request $request = null)
    {
        $data = $this->repository->with(['products.reviews'])->whereId($subcategory_id)->get();

        $collection = new Collection();

        $sub = '';

        foreach ($data as $subcategory) {

            $sub = $subcategory;
            foreach ($subcategory->products as $product) {

                $collection->push($product);
            }

        }

        $pages = $this->paginateCollection($collection, 5, null, $request);

        return compact('pages', 'sub');
    }
}