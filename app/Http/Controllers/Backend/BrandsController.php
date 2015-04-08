<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\Brands\Base\Brands;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Brands\BrandFormRequest;
use App\Http\Requests\Inventory\DeleteInventoryRequest;
use App\Models\Brand;
use Response;

class BrandsController extends Controller
{
    /**
     * The brands module
     *
     * @var Brands
     */
    protected $brand;

    /**
     * @param Brands $brands
     */
    public function __construct(Brands $brands)
    {
        $this->brand = $brands;
    }

    /**
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $brands = $this->brand->get();

        return view('backend.Brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new productbrand
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Brands.create');
    }

    /**
     * Store a newly created productbrand in storage.
     *
     * @param BrandFormRequest $request
     *
     * @return Response
     */
    public function store(BrandFormRequest $request)
    {
        return $this->brand->create($request->except('_token'))->handleRedirect($request);
    }

    /**
     * Display the specified productbrand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brand->retrieve($id);

        return view('backend.Brands.edit', compact('brand'));
    }

    /**
     * Show the form for editing the specified productbrand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brand = $this->brand->retrieve($id);

        return view('backend.Brands.edit', compact('brand'));
    }

    /**
     * Update the specified productbrand in storage.
     *
     * @param BrandFormRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(BrandFormRequest $request, $id)
    {
        return $this->brand->edit($id, $request->except('_token'))->handleRedirect($request);
    }

    /**
     * Remove the specified productbrand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(DeleteInventoryRequest $request, $id)
    {
        return $this->brand->delete($id)->handleRedirect($request);
    }

}
