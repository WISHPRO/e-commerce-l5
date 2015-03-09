<?php namespace app\Http\Controllers\Backend;

use app\Anto\Logic\repositories\BrandsRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Response;

class BrandsController extends Controller
{
    private $brand = null;

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
        $brands = $this->brand->paginate(['products'], 5);

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
     * @return Response
     */
    public function store(BrandFormRequest $request)
    {
        $id = $this->brand->add($request->all())->id;

        flash()->success('Brand with id '.$id." successfully created");

        return redirect()->route('brands.view');
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

        return view('backend.Brands.show', compact('brand'));
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
     * @param  int $id
     *
     * @return Response
     */
    public function update(BrandFormRequest $request, $id)
    {
        $brand = $this->brand->find($id)->update($request->all());

        flash()->success('The brand with id '. $id . ' was successfully updated');

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
        if($this->brand->delete([$id]) == 1){
            flash()->success("The brand was successfully deleted");

            return redirect()->route('brands.view');
        }
        flash()->error('Delete action failed. Please try again later');

        return redirect()->route('brands.view');
    }

}
