<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Response;

class SubCategoriesController extends Controller
{

    /**
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $subcategories = SubCategory::with( 'category' )->paginate( 5 );

        return view( 'backend.SubCategories.index', compact( 'subcategories' ) );
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
        return view( 'backend.SubCategories.create' );
    }

    /**
     * Store a newly created subCategory in storage.
     *
     * @return Response
     */
    public function store( SubCategoryRequest $request )
    {
        SubCategory::create( $request->all() );

        \Flash::success( 'Subcategory successfully created' );

        return \Redirect::route( 'subcategories.view' );
    }

    /**
     * Display the specified SubCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $subcategory = SubCategory::with( 'category' )->findOrFail( $id );

        return view( 'backend.SubCategories.edit', compact( 'subcategory' ) );
    }

    /**
     * Show the form for editing the specified SubCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $subcategory = SubCategory::with( 'category' )->findOrFail( $id );

        return view( 'backend.SubCategories.edit', compact( 'subcategory' ) );
    }

    /**
     * Update the specified subCategory in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(SubCategoryRequest $request, $id )
    {
        $subcategory = SubCategory::findOrFail($id);

        $subcategory->update($request->all());

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
    public function destroy( $id )
    {
        SubCategory::destroy( $id );

        flash()->success( 'Successfully deleted subcategory with id ' . $id );

        return redirect(action('Backend\SubCategoriesController@index'));
    }

}
