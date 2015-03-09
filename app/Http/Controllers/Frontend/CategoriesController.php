<?php namespace app\Http\Controllers\Frontend;

use app\Anto\domainLogic\repositories\CategoriesRepository;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Response;

class CategoriesController extends Controller
{

    private $category = null;

    public function __construct(CategoriesRepository $repository)
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
        $categories = $this->category->paginate(['subcategories']);

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
    public function show($id)
    {
        // retrieve the category id, and display all related products, regardless of sub-category
        $data = $this->category->plus(['products.subcategories', 'products.reviews', 'products.brands'])->whereId($id)->paginate(10);

        return view('frontend.Categories.display', compact('data'));
    }

}