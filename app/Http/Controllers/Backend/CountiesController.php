<?php namespace App\Http\Controllers\Backend;

use App\Antony\DomainLogic\Modules\Counties\CountiesRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counties\CountyRequest;
use App\Models\County;
use Response;

class CountiesController extends Controller
{

    protected $county;

    /**
     * @param CountiesRepository $repository
     */
    public function __construct(CountiesRepository $repository)
    {
        $this->county = $repository;
    }

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $counties = $this->county->paginate();

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
     * @param CountyRequest $request
     *
     * @return Response
     */
    public function store(CountyRequest $request)
    {
        $data = $this->county->add($request->all());

        $data->id != null ? flash('The county was created') : flash()->error('Action failed');

        if ($request->ajax()) {
            return response()->json(['county' => $data, 'message' => 'The county was created']);
        }
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
        $county = $this->county->find($id);

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
        $county = $this->county->find($id);

        return view('backend.Counties.edit', compact('county'));
    }

    /**
     * Update the specified county in storage.
     *
     * @param CountyRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(CountyRequest $request, $id)
    {
        $county = $this->county->update($request->all(), $id);

        if ($request->ajax()) {
            return response()->json(['county' => $county, 'message' => 'The county was successfully updated']);
        }

        flash('county information successfully updated');

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
        if ($this->county->delete([$id])) {
            flash('county was deleted successfully');

            return redirect(action('Backend\CountiesController@index'));
        }

        flash()->error('Delete failed. Please try again later');

        return redirect()->back();

    }

}
