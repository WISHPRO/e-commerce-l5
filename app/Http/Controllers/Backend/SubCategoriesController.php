<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\Subcategory\SubcategoriesRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Response;

class SubCategoriesController extends Controller
{

    protected $subcategory;

    public function __construct(SubcategoriesRepository $repository)
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
        $subcategories = $this->subcategory->paginate(['category']);

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
     * @return Response
     */
    public function store(SubCategoryRequest $request)
    {
        $this->subcategory->add($request->all());

        flash()->success('Subcategory successfully created');

        return redirect()->route('backend.subcategories.index');
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
        $subcategory = $this->subcategory->find($id, ['category']);

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
        $subcategory = $this->subcategory->find($id, ['category']);

        return view('backend.SubCategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified subCategory in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        $subcategory = $this->subcategory->find($id, ['category'])->update($request->all());

        flash()->success('The subcategory was successfully updated');

        return redirect(action('Backend\SubCategoriesController@index'));
    }

    /**
     * Remove the specified subCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->subcategory->delete([$id]);

        flash()->success('Successfully deleted subcategory with id ' . $id);

        return redirect(action('Backend\SubCategoriesController@index'));
    }

}
