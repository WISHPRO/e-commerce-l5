<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Categories\Base\Categories;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Response;

class CategoriesController extends Controller
{

    protected $category;

    /**
     * @param Categories $repository
     */
    public function __construct(Categories $repository)
    {
        $this->category = $repository;
    }

    /**
     * Display a listing of the resource.
     * GET /categories
     *
     * @return Response
     */
    public function index()
    {
        // display a listing of all categories. sort of a sitemap
        $categories = $this->category->displayCategoryListing();

        return view('frontend.Categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     * GET /categories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // retrieve the category id, and display all related products, regardless of sub-category
        $data = $this->category->displayCategoryAndRelatedProducts($id, $request);

        return view('frontend.Categories.display')
            ->with('category', array_get($data, 'cat'))
            ->with('products', array_get($data, 'pages'));
    }

}