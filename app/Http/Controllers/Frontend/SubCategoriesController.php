<?php namespace App\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\SubCategories\SubcategoriesRepository;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Response;

class SubCategoriesController extends Controller
{
    protected $subcategory;

    /**
     * @param SubcategoriesRepository $repository
     */
    public function __construct(SubcategoriesRepository $repository)
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
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = $this->subcategory->with(['products.reviews'])->whereId($id)->paginate(
            10
        );

        return view('frontend.Subcategories.products', compact('data'));
    }
}