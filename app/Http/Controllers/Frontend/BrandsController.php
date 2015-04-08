<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Brands\Base\Brands;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Response;

class BrandsController extends Controller
{
    protected $brand;

    /**
     * @param Brands $brands
     */
    public function __construct(Brands $brands)
    {
        $this->brand = $brands;
    }

    /**
     * Display a listing of all brands
     *
     * @return Response
     */
    public function index()
    {
        $brands = $this->brand->get();

        return view('backend.productbrands.index', compact('brands'));
    }


    /**
     * Display products within the brand
     *
     * @param Request $request
     * @param  int $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $data = $this->brand->displayProductsWithBrands($id, $request);

        return view('frontend.Brands.products')
            ->with('brand', array_get($data, 'brand'))
            ->with('products', array_get($data, 'pages'));
    }

}
