<?php namespace app\Antony\DomainLogic\Modules\Advertisements\Base;

use App\Antony\DomainLogic\Modules\Advertisements\AdvertisementsRepo;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use app\Antony\DomainLogic\Modules\Product\Base\Products;

class Advertisements extends DataAccessLayer
{

    /**
     * @var Products
     */
    private $products;

    /**
     * @param AdvertisementsRepo $advertisementsRepo
     * @param Products $products
     */
    public function __construct(AdvertisementsRepo $advertisementsRepo, Products $products)
    {
        parent::__construct($advertisementsRepo);
        $this->products = $products;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate(['product']);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function displayCategoryAds($id)
    {
        // find an advert by its id, and attempt to resolve its target
        $data = $this->advertisementsRepo->resolve($id);

        // for this case, we quietly handle the modelNotFoundException by performing a redirect to the homepage
        if (is_null($data)) {

            return redirect()->route('home');
        }

        // resolve the product targeted by the advertisement
        if (!empty(array_get($data, 'product'))) {

            $product = $this->products->repository->find(array_get($data, 'product'));

            return redirect()->action('Frontend\ProductsController@show', ['id' => array_get($data, 'product'), 'name' => str_slug($product->name)]);
        }
        return redirect()->route('home');
    }

    /**
     *
     */
    public function displayBannerAds()
    {

    }
}