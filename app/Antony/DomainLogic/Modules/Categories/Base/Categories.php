<?php namespace app\Antony\DomainLogic\Modules\Categories\Base;

use App\Antony\DomainLogic\Modules\Categories\CategoriesRepository;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Categories extends DataAccessLayer
{
    protected $objectName = 'categories';

    /**
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        parent::__construct($categoriesRepository);

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate();
    }

    /**
     * @return mixed
     */
    public function displayCategoryListing()
    {
        return $this->repository->paginate(['subcategories']);
    }

    /**
     * @param $category_id
     *
     * @return mixed
     */
    public function displayCategoryAndRelatedProducts($category_id, Request $request)
    {
        $data = $this->repository->with(['products.subcategories', 'products.reviews', 'products.brands'])->whereId($category_id)->get();

        $collection = new Collection();

        $cat = '';

        foreach ($data as $category) {

            $cat = $category;
            foreach ($category->products as $product) {

                $collection->push($product);
            }

        }

        $pages = $this->paginateCollection($collection, 5, null, $request);

        return compact('pages', 'cat');
    }
}