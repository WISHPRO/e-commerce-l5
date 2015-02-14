<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Response;

class ProductsController extends Controller {

	/**
	 * Display a listing of products
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();

		$products->load('name', 'price');

		return view('frontend.products.index', compact('products'));
	}

	/**
	 * Display the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = Product::with('reviews')->findOrFail($id);
//		dd($products);
		return view('frontend.products.single', compact('product'));
	}

}
