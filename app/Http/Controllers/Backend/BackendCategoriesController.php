<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Response;

class BackendCategoriesController extends Controller
{

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::paginate( 5 );

        return view( 'backend.categories.index', compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new Category
     *
     * @return Response
     */
    public function create()
    {
        return view( 'backend.categories.create' );
    }

    /**
     * Store a newly created Category in storage.
     *
     * @return Response
     */
    public function store( CategoryRequest $request )
    {
        $id = Category::create( $request->all() )->id;

        \Flash::success( 'Product category created successfully. Its id is ' . $id );

        return \Redirect::route( 'categories.view' );
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $category = Category::findOrFail( $id );

        return view( 'backend.categories.edit', compact( 'category' ) );
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $category = Category::find( $id );

        return view( 'backend.categories.edit', compact( 'category' ) );
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {

    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        Category::destroy( $id );

        \Flash::success( 'category with id ' . $id . "successfully deleted" );

        return \Redirect::route( 'categories.view' );
    }

}
