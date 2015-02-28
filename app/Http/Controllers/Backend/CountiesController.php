<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountyRequest;
use App\Models\County;
use Illuminate\Support\Facades\Request;
use Response;

class CountiesController extends Controller
{

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $counties = County::paginate(5);

        return view('backend.Counties.index', compact('counties'));
    }

    /**
     * Show the form for creating a new county
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Counties.create');
    }

    /**
     * Store a newly created county in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(CountyRequest $request)
    {
        $id = County::create($request->all())->id;

        $id != null ? flash()->success('The county was created')
            : flash()->error('Action failed');

        return redirect(action('Backend\CountiesController@index'));

    }

    /**
     * Display the specified county.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $county = County::findOrFail($id);

        return view('backend.Counties.edit', compact('county'));
    }

    /**
     * Show the form for editing the specified county.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $county = County::find($id);

        return view('backend.Counties.edit', compact('county'));
    }

    /**
     * Update the specified county in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(CountyRequest $request, $id)
    {
        $county = county::findOrFail($id);

        $county->update($request->all());

        flash()->success('county information successfully updated');

        return redirect(action('Backend\CountiesController@index'));
    }

    /**
     * Remove the specified county from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        county::destroy($id);

        flash()->success('county was deleted successfully');

        return redirect(action('Backend\CountiesController@index'));
    }

}
