<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use app\Models\Product;
use app\Models\SubCategory;
use Response;

class SubCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /subcategories
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /subcategories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $data = SubCategory::with('products.reviews')->whereId($id)->paginate(10);

        return view('frontend.subcategories.products', compact('data'));
    }
}