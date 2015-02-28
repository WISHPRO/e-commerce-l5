<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Response;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /categories
     *
     * @return Response
     */
    public function index()
    {
        // display a listing of all categories. sort of a sitemap
        $categories = Category::with('subcategories')->paginate(10);

        return view('frontend.categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     * GET /categories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // retrieve the category id, and display all related products, regardless of sub-category
        $data = Category::with('products', 'subcategories')->paginate(10);

        return view('frontend.categories.display', compact('data'));
    }

}