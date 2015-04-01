<?php namespace App\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\Brands\BrandsRepository;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Response;

class BrandsController extends Controller
{
    protected $brand;

    /**
     * @param BrandsRepository $brandsRepository
     */
    public function __construct(BrandsRepository $brandsRepository)
    {
        $this->brand = $brandsRepository;
    }

    /**
     * Display a listing of all brands
     *
     * @return Response
     */
    public function index()
    {
        $brands = $this->brand->paginate(['products']);

        return view('backend.productbrands.index', compact('brands'));
    }


    /**
     * Display products within the brand
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brands = $this->brand->with(['products.categories', 'products.reviews', 'products.subcategories'])->where('id', $id)->paginate(10);

        return view('frontend.brands.products', compact('brands'));
    }

}
