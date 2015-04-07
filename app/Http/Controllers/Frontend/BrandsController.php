<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Brands\Base\Brands;
use App\Http\Controllers\Controller;
use App\Models\Brand;
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
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brands = $this->brand->displayProductsWithBrands($id);

        return view('frontend.brands.products', compact('brands'));
    }

}
