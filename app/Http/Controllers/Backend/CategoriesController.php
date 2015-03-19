<?php namespace app\Http\Controllers\Backend;

use app\Anto\domainLogic\repositories\CategoriesRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Response;

class CategoriesController extends Controller
{
    protected $category;

    /**
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
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
        $categories = $this->category->paginate();

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
        $id = $this->category->add($request->all())->id;

        flash()->success('Product category created successfully. Its id is ' . $id);

        return redirect(action('Backend\CategoriesController@index'));
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
        $category = $this->category->find($id);

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
        $category = $this->category->find($id);

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
        $category = $this->category->modify($request->all(), $id);

        flash()->success('category successfully updated');

        return redirect(action('Backend\CategoriesController@index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->category->delete([$id]) == 1) {
            flash()->success('category with id ' . $id . "successfully deleted");

            return redirect(action('Backend\CategoriesController@index'));
        }

        flash()->error('Delete failed. Please try again later');

        return redirect()->back();
    }

}
