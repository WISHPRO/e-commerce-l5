<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\Counties\Base\Counties;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counties\CountyRequest;
use App\Models\County;
use Illuminate\Http\Request;
use Response;

class CountiesController extends Controller
{

    protected $county;

    public function __construct(Counties $repository)
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
        $counties = $this->county->get();

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
        return $this->county->create($request->except('_token'))->handleRedirect($request);
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
        $county = $this->county->retrieve($id);

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
        $county = $this->county->retrieve($id);

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
        return $this->county->edit($id, $request->except('_token'))->handleRedirect($request);
    }

    /**
     * Remove the specified county from storage.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->county->delete($id)->handleRedirect($request);
    }

}
