<?php namespace app\Http\Controllers\Frontend;

use app\Anto\DomainLogic\repositories\Ads\AdvertisementsRepo;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Response;

class AdsController extends Controller
{

    protected $add;

    protected $product;

    /**
     * @param AdvertisementsRepo $advertisementsRepo
     */
    public function __construct(AdvertisementsRepo $advertisementsRepo, ProductRepository $productRepository)
    {
        $this->add = $advertisementsRepo;

        $this->product = $productRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // find an advert by its id, and attempt to resolve its target
        $data = $this->add->resolve($id);

        // for this case, we quietly handle the modelNotFoundException by performing a redirect to the homepage
        if (is_null($data)) {

            return redirect()->route('home');
        }

        // resolve the product targeted by the advertisement
        if (!empty(array_get($data, 'product'))) {

            $product = $this->product->find(array_get($data, 'product'));

            return redirect()->action('Frontend\ProductsController@show', ['id' => array_get($data, 'product'), 'name' => str_slug($product->name)]);
        }

        // for now, ill stop here

        return redirect()->route('home');

    }
}
