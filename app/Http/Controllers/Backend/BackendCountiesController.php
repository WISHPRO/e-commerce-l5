<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\County;
use Illuminate\Support\Facades\Request;
use Redirect;
use Response;

class BackendCountiesController extends Controller
{

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $counties = County::paginate(5);

        return view('backend.counties.index', compact('counties'));
    }

    /**
     * Show the form for creating a new county
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.counties.create');
    }

    /**
     * Store a newly created county in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $county = new County();
        $county->name = Input::get('name');
        $county->alias = Input::get('alias');

        if (!$county->validate()) {
            return Redirect::back()->withErrors($county->errors())->withInput()->with('message', $this->FormErrorMsg)->with('alertclass', 'alert-danger');
        }

        return $county->save() ? Redirect::route('counties.view')->with('message', $this->successMsg)->with('alertclass', 'alert-success') : Redirect::back()->withErrors($county->errors())->withInput()->with('message', 'Adding the county failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
    }

    /**
     * Display the specified county.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $county = County::findOrFail($id);

        return view('backend.counties.edit', compact('county'));
    }

    /**
     * Show the form for editing the specified county.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $county = County::find($id);

        return view('backend.counties.edit', compact('county'));
    }

    /**
     * Update the specified county in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $county = county::findOrFail($id);

        $validator = Validator::make($data = Input::all(), county::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('message', 'update failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }

        $county->update($data);

        return Redirect::route('counties.view')->with('message', 'successfully updated county with id ' . $id)->with('alertclass', 'alert-success');
    }

    /**
     * Remove the specified county from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        county::destroy($id);

        return Redirect::route('counties.view')->with('message', 'successfully deleted county with id ' . $id)->with('alertclass', 'alert-success');
    }

}
