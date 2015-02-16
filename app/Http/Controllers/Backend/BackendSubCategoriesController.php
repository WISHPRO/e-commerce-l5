<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Response;

class BackendSubCategoriesController extends Controller
{

    /**
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate(5);
        
        return view('backend.subcategories.index', compact('subcategories'));
    }

    // retrieve the subcategories count. we want the admin or whouever to create a category first before creating a sub-category
    // this avoids integrity violations, since a sub-cat must belong to a category

    /**
     * Show the form for creating a new subCategory
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.subcategories.create');
    }

    /**
     * Store a newly created subCategory in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha',
            'alias' => 'alpha',
            'banner' => 'image|between:5,2000',
            'category_id' => 'required'
        ]);

        SubCategory::create($request->all());

        \Flash::success('Subcategory successfully created');
    }

    /**
     * Display the specified SubCategory.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);

        return view('backend.subcategories.edit', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified SubCategory.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);

        return view('backend.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified subCategory in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified subCategory from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        SubCategory::destroy($id);

        \Flash::success('Successfully deleted subcategory with id ' . $id);

        return \Redirect::route('subcategories.view');
    }

}
