<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use app\Models\Product;
use app\Models\SubCategory;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of products
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::with('categories.subcategories', 'brands')
            ->paginate(10);

        return view('backend.Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     *
     * @return Response
     */
    public function create()
    {
        $info = SubCategory::with('category');

        return view('backend.Products.create', compact('info'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param ProductRequest $request
     *
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        // now that the request is valid, once we reach here, we just add the product to db
        $id = Product::create($request->all())->id;

        \Flash::success('Product successfully created. Its id is '.$id);

        return redirect(action('Backend\ProductsController@index'));

    }

    /**
     * Display the specified product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.Products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('backend.Products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        flash()->success('The product was successfully updated');

        return redirect(action('Backend\ProductsController@index'));
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        \Flash::success('successfully deleted product with id '.$id);

        return redirect(action('Backend\ProductsController@index'));
    }

}
