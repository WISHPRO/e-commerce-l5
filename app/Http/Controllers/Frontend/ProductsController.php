<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use app\Models\User;
use Response;

class ProductsController extends Controller
{

    /**
     * Display a listing of products
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();

        $products->load( 'name', 'price' );

        return view( 'frontend.Products.index', compact( 'products' ) );
    }

    /**
     * Display the specified product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $product = Product::with( 'categories', 'reviews.user' )->findOrFail( $id );

        return view( 'frontend.Products.single', compact( 'product' ) );
    }

}
