<?php namespace App\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\Product\ProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;

class ProductsController extends Controller
{

    protected $product;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
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
        $products = $this->product->paginate(['categories', 'subcategories', 'brand']);

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
        $product = $this->product->find($id, ['categories', 'subcategories', 'reviews.user', 'brands']);

        return view('frontend.Products.single', compact('product'));
    }


    public function email(Request $request, $id)
    {

    }

}
