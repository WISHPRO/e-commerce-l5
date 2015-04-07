<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\SubCategories\Base\SubCategories;
use App\Http\Controllers\Controller;
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
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data = $this->subcategory->includeRelatedProducts($id);

        return view('frontend.Subcategories.products', compact('data'));
    }
}