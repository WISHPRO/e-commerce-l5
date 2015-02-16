<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Response;


class BrandsController extends Controller
{

    /**
     * Display a listing of all brands
     *
     * @return Response
     */
    public function index()
    {
        $brands = Brand::paginate(5);

        return view('backend.productbrands.index', compact('brands'));
    }


    /**
     * Display products within the brand
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $brands = Brand::with('products.reviews')->whereId($id)->paginate(5);

        return view('frontend.brands.products', compact('brands'));
    }

}
