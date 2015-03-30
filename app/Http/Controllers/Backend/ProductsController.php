<?php namespace app\Http\Controllers\Backend;

use App\Antony\DomainLogic\modules\Product\ProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Products\ProductRequest;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    protected $product;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->product = $repository;
    }

    /**
     * Display a listing of products
     *
     * @return Response
     */
    public function index()
    {
        $inventoryCount = $this->product->where('quantity', '<>', '0')->fetch('quantity')->sum();

        $products = $this->product->paginate(['categories', 'subcategories', 'brands'], 10);

        return view('backend.Products.index', compact('products', 'inventoryCount'));
    }

    /**
     * Show the form for creating a new product
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Products.create');
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
        $id = $this->product->add($request->all())->id;

        flash('Product successfully created. Its id is ' . $id);

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
        $product = $this->product->find($id);

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
        $product = $this->product->find($id);

        return view('backend.Products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param ProductRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->product->update($request->all(), $id);

        flash('The product was successfully updated');

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
        if ($this->product->delete([$id])) {
            flash()->success('successfully deleted product with id ' . $id);

            return redirect(action('Backend\ProductsController@index'));
        }

        flash()->error('Delete failed. Please try again later');

        return redirect()->back();
    }

}
