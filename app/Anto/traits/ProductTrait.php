<?php namespace app\Anto\Traits;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\SubCategory;
use Response;
use Redirect;

trait ProductTrait {

    /**
     * Display a listing of products
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::with('categories.subcategories', 'brands')->paginate(10);

        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     *
     * @return Response
     */
    public function create()
    {
        $info = SubCategory::with('category');

        return view('backend.products.create', compact('info'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param CreateProductRequest $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        // now that the request is valid, once we reach here, we just add the product to db
        $id = Product::create($request->all())->id;

        \Flash::success('Product successfully created. Its id is '. $id);

        return Redirect::route('products.view');

    }

    /**
     * Display the specified product.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('backend.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        \Flash::success('successfully deleted product with id ' . $id);

        return Redirect::route('products.view');
    }
}