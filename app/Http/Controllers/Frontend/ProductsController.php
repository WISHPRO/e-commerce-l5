<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Product\Base\Products;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{

    protected $product;

    /**
     * @param Products $productRepository
     */
    public function __construct(Products $productRepository)
    {
        $this->product = $productRepository;
    }

    /**
     * Display a listing of products
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->product->get();

        return view('frontend.Products.index', compact('products'));
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
        $product = $this->product->displayProductData($id);

        return view('frontend.Products.single', compact('product'));
    }


    public function email(Request $request, $id)
    {
        //
    }

}
