<?php namespace App\Http\Controllers\Backend;

use app\Antony\DomainLogic\Modules\Advertisements\Base\Advertisements;
use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisements\AdvertisementsRequest;
use App\Http\Requests\Inventory\DeleteInventoryRequest;
use Illuminate\Http\Response;


class AdvertisementsController extends Controller
{

    protected $advertisement;

    /**
     * @param Advertisements $advertisementsRepo
     */
    public function __construct(Advertisements $advertisementsRepo)
    {
        $this->advertisement = $advertisementsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ads = $this->advertisement->get();

        return view('backend.Ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.Ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdvertisementsRequest $request
     *
     * @return Response
     */
    public function store(AdvertisementsRequest $request)
    {
        return $this->advertisement->create($request->except('_token'))->handleRedirect($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdvertisementsRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(AdvertisementsRequest $request, $id)
    {
        return $this->advertisement->edit($id, $request->except('_token'))->handleRedirect($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(DeleteInventoryRequest $request, $id)
    {
        return $this->advertisement->delete($id)->handleRedirect($request);
    }

}
