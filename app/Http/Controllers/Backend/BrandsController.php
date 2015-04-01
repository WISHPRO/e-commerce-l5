<?php namespace App\Http\Controllers\Backend;

use App\Antony\DomainLogic\Modules\Brands\BrandsRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Brands\BrandFormRequest;
use App\Models\Brand;
use Response;

class BrandsController extends Controller
{
    /**
     * The brand model object
     *
     * @var object
     */
    protected $brand;

    /**
     * @param BrandsRepository $brandsRepository
     */
    public function __construct(BrandsRepository $brandsRepository)
    {
        $this->brand = $brandsRepository;
    }

    /**
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $brands = $this->brand->paginate(['products']);

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
        $id = $this->brand->add($request->all())->id;

        flash('Brand with id ' . $id . " successfully created");

        return redirect()->route('backend.brands.index');
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
        $brand = $this->brand->find($id);

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
        $brand = $this->brand->find($id);

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
        $brand = $this->brand->update($request->all(), $id);

        flash('The brand with id ' . $id . ' was successfully updated');

        return redirect()->route('backend.brands.index');

    }

    /**
     * Remove the specified productbrand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->brand->delete([$id])) {
            flash()->success("The brand was successfully deleted");

            return redirect()->route('backend.brands.index');
        }
        flash()->error('Delete action failed. Please try again later');

        return redirect()->route('backend.brands.index');
    }

}
