<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\Counties\CountiesRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountyRequest;
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
        $id = $this->county->add($request->all())->id;

        $id != null ? flash()->success('The county was created') : flash()->error('Action failed');

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
        if ($this->county->delete([$id])) {
            flash()->success('county was deleted successfully');

            return redirect(action('Backend\CountiesController@index'));
        }

        flash()->error('Delete failed. Please try again later');

        return redirect()->back();

    }

}
