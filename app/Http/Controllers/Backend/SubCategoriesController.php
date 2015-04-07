<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\SubCategories\Base\SubCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\SubCategories\SubCategoryRequest;
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
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $subcategories = $this->subcategory->get();

        return view('backend.SubCategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new subCategory
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.SubCategories.create');
    }

    /**
     * Store a newly created subCategory in storage.
     *
     * @param SubCategoryRequest $request
     *
     * @return Response
     */
    public function store(SubCategoryRequest $request)
    {
        return $this->subcategory->create($request->all())->handleRedirect($request);
    }

    /**
     * Display the specified SubCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subcategory = $this->subcategory->retrieve($id);

        return view('backend.SubCategories.edit', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified SubCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subcategory = $this->subcategory->retrieve($id);

        return view('backend.SubCategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified subCategory in storage.
     *
     * @param SubCategoryRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        return $this->subcategory->edit($id, $request->all())->handleRedirect($request);
    }

    /**
     * Remove the specified subCategory from storage.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->subcategory->delete($id)->handleRedirect($request);
    }

}
