<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Models\AnonymousMessages;
use App\Models\Settings;
use Response;

class InfoController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /info
     *
     * @return Response
     */
    public function about()
    {
        return view('frontend.info.about');
    }

    /**
     * Display the specified resource.
     * GET /info/
     *
     * @return Response
     * @internal param int $id
     */
    public function contact()
    {
        return view('frontend.info.contact');
    }

    /**
     * Display the terms and conditions page
     * GET /terms/
     *
     * @return \Illuminate\View\View
     */
    public function Terms()
    {
        // the settings id for terms and conditions is 1
        $terms = Settings::find('1');

        return view('frontend.info.policy', compact('terms'));
    }

    /*
     * store anonymous user messages
     * POST /info
     * */
    public function store(ContactMessageRequest $request)
    {
        AnonymousMessages::create($request->all());

        \Session::flash('message_submitted', true);

        flash()->overlay('Your message was successfully sent');

        return redirect()->back();
    }

}