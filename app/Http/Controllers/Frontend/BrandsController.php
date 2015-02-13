<?php
use App\Http\Controllers\Controller;


class BrandsController extends Controller
{

    /**
     * Display a listing of all brands
     *
     * @return Response
     */
    public function index()
    {
        $brands = Brand::with('products')->paginate(5);

        return View::make('backend.productbrands.index', compact('brands'));
    }


    /**
     * Display products within the brand
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $brands = Brand::with('products')->whereId($id)->paginate(5);

        return View::make('frontend.brands.products', compact('brands'));
    }

}
