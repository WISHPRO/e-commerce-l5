<?php namespace app\Antony\DomainLogic\Modules\Product\Base;

use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\Product\ProductRepository;
use Carbon\Carbon;

class Products extends DataAccessLayer
{

    /**
     * Object name that will be displayed in the redirect msg
     *
     * @var string
     */
    protected $objectName = 'products';

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    /**
     * Displays a listing of all products
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate(['categories', 'subcategories', 'brands']);
    }

    /**
     * Displays a sum of individual products in the database
     *
     * @return mixed
     */
    public function getInventoryCount()
    {
        return $this->repository->where('quantity', '<>', '0')->get()->fetch('quantity')->sum();
    }

    /**
     * Gets the sum of all products in the db. for instance, if a single product has a qt of 10, we shall get 10 instead of 1
     *
     * @return mixed
     */
    public function getAllProductsCount()
    {

        return $this->repository->all()->count();
    }

    /**
     * Displays all data about a single product
     *
     * @param $id
     *
     * @return mixed
     */
    public function displayProductData($id)
    {

        return $this->repository->find($id, ['categories', 'subcategories', 'reviews.user', 'brands']);
    }

    /**
     * Displays top rated products
     *
     * @return mixed
     */
    public function displayTopRated()
    {
        // we first fetch all products with reviews. Then get those that meet our criteria
        // our criteria states that a top rated product should have at least 4.0 stars and
        // be reviewed at least 2 times. The hard coded values are just defaults, just in-case
        // the ones in our config are missing

        // for now, that criteria will be ok, since we have a few products and users
        $data = $this->repository->with(['reviews'])->whereHas('reviews', function ($q) {

            $q->where('stars', '>=', config('site.reviews.hottest', 3.5));

        }, '>=', config('site.reviews.count', 10))->get();

        return $data;
    }

    /**
     * Display new products on the home page
     *
     * @return mixed
     */
    public function displayNewProducts()
    {
        $time = new Carbon('last friday');

        $data = $this->repository->with(['reviews', 'brands'])->where('created_at', '>=', $time)->get()->take(10);

        return $data;
    }
}