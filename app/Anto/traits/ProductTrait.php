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
        $products = Product::with('categories.subcategories', 'brands')->paginate();

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

        $product = new Product();

        //dd(print_r(Input::file('img_1')));
        if (!$product->save()) {

            return \Redirect::back()->withErrors($product->errors())->withInput()->with('message', 'Adding the product because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }

        return Redirect::route('products.view')->with('message', $this->successMsg)->with('alertclass', 'alert-success');
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
        $product = Product::findOrFail($id);

        if (!$product->updateUniques()) {
            return Redirect::back()->withErrors($product->errors())->withInput()->with('message', 'update failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }

        return Redirect::route('products.view')->with('message', 'successfully updated product with id ' . $id)->with('alertclass', 'alert-success');
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

        return Redirect::route('products.view')->with('message', 'successfully deleted product with id ' . $id)->with('alertclass', 'alert-success');
    }
}