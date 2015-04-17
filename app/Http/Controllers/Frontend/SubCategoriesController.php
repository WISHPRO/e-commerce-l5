<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\SubCategories\Base\SubCategories;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Response;

class SubCategoriesController extends Controller
{
    protected $subcategory;

    /**
     * @param SubCategories $repository
     */
    public function __construct(Subcategories $repository)
    {
        $this->subcategory = $repository;
    }

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
     * @param Request $request
     * @param  int $id
     *
     * @return Response
     */
    public function show(Request $request, SubCategory $subCategory)
    {
        $data = $this->subcategory->includeRelatedProducts($subCategory->id, $request);

        return view('frontend.Subcategories.products', $data)
            ->with('subcategory', array_get($data, 'sub'))
            ->with('products', array_get($data, 'pages'));
    }
}