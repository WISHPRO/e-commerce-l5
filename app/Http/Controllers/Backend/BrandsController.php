<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Response;

class BrandsController extends Controller
{

    /**
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $brands = Brand::with('products')->paginate(5);

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
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|alpha_dash|between:2,15|unique:brands',
                'logo' => 'required|mimes:png|between:1,1000',
            ]
        );

        $id = Brand::create($request->all())->id;

        \Flash::success('Brand with id '.$id." successfully created");

        return \Redirect::route('brands.view');
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
        $brand = Brand::findOrFail($id);

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
        $brand = Brand::findOrFail($id);

        return view('backend.Brands.edit', compact('brand'));
    }

    /**
     * Update the specified productbrand in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->validate()) {
            return Redirect::back()->withErrors($brand->errors())->withInput()
                ->with(
                    'message',
                    $this->FormErrorMsg
                )->with('alertclass', 'alert-danger');
        }

        // attempt update
        if ($brand->updateUniques()) {
            return Redirect::route('brands.view')->with(
                'message',
                'successfully updated the brand with id '.$id
            )->with('alertclass', 'alert-success');
        }

        return Redirect::back()->with(
            'message',
            'an error occured. please try again later'
        )->with(
            'alertclass',
            'alert-danger'
        );

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
        if (Brand::destroy($id) == 1) {
            \Flash::success('brand with id '.$id." successfully deleted");
            \Redirect::route('brands.view');
        } else {
            \Flash::error('delete failed. please try again');
            \Redirect::back();
        }


    }

}
