<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\Categories\Base\Categories;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Categories\CategoryRequest;
use App\Http\Requests\Inventory\DeleteInventoryRequest;
use App\Models\Category;
use Response;

class CategoriesController extends Controller
{
    protected $category;

    public function __construct(Categories $categoriesRepository)
    {
        $this->category = $categoriesRepository;
    }

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->get();

        return view('backend.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new Category
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CategoryRequest $request
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        return $this->category->create($request->except('_token'))->handleRedirect($request);
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->category->retrieve($id);

        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->category->retrieve($id);

        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param CategoryRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        return $this->category->edit($id, $request->except('_token'))->handleRedirect($request);
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(DeleteInventoryRequest $request, $id)
    {
        return $this->category->delete($id)->handleRedirect($request);
    }

}
