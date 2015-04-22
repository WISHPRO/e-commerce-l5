<?php namespace app\Antony\DomainLogic\Modules\Categories\Base;

use App\Antony\DomainLogic\Modules\Categories\CategoriesRepository;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Categories extends DataAccessLayer
{
    /**
     * Object name that will be displayed in the redirect msg
     *
     * @var string
     */
    protected $objectName = 'categories';

    /**
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        parent::__construct($categoriesRepository);

    }

    /**
     * Displays a listing of all categories in a paginated fashion
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate();
    }

    /**
     * Displays a listing of categories, with their subcategories. This is for the site navigation bar
     *
     * @return mixed
     */
    public function displayCategoryListing()
    {
        return $this->repository->paginate(['subcategories', 'adverts']);
    }


    /**
     * Really self explanatory. Displays products within a category
     *
     * @param $category_id
     * @param Request $request
     *
     * @return array
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

    /**
     * Displays categories on the navigation bar
     *
     * @return mixed
     */
    public function displayCategories()
    {
        $data = $this->repository->with(['subcategories'])->take(5)->orderBy('name', 'asc')->get();

        return $data;
    }
}