<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\Product\Base\Products;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Products\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    protected $product;

    /**
     * @param Products $repository
     */
    public function __construct(Products $repository)
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
        $inventoryCount = $this->product->getInventoryCount();

        $productsCount = $this->product->getAllProductsCount();

        $products = $this->product->get();

        return view('backend.Products.index', compact('products', 'inventoryCount', 'productsCount'));
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
        return $this->product->create($request->except('_token'))->handleRedirect($request);
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
        $product = $this->product->retrieve($id);

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
        $product = $this->product->retrieve($id);

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
        return $this->product->edit($id, $request->all())->handleRedirect($request);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->product->delete($id)->handleRedirect($request);
    }

}
