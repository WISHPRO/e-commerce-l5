<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\Ads\AdvertisementsRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\adsRequest;
use Response;

class AdvertisementsController extends Controller {

    protected $add;

    public function __construct(AdvertisementsRepo $advertisementsRepo){
        $this->add = $advertisementsRepo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $ads = $this->add->paginate(['representation', 'product']);

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
	 * @return Response
	 */
	public function store(adsRequest $request)
	{
        $id = $this->add->add($request->all())->id;

        flash('advert was created. its id is '. $id);

        return redirect()->route('backend.ads.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
