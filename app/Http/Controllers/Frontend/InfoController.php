<?php

use App\Http\Controllers\Controller;

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
        return View::make('frontend.info.about');
    }

    /**
     * Display the specified resource.
     * GET /info/
     * @return Response
     * @internal param int $id
     */
    public function contact()
    {
//		$data = [
//			'location' => Settings::whereName('STORE_LOCATION')->get(),
//			'mail' => Settings::whereName('STORE_CONTACTS_MAIL')->get(),
//			'workingHours' => Settings::whereName('STORE_WORKING_HOURS')->get()
//		];

        return View::make('frontend.info.contact');
    }

    /**
     * Display the terms and conditions page
     * GET /terms/
     * @return \Illuminate\View\View
     */
    public function Terms()
    {
        // the settings id for terms and conditions is 1
        $terms = Settings::find('1');

        return View::make('frontend.info.policy', compact('terms'));
    }

    /*
     * store anonymous user messages
     * POST /info
     * */
    public function store()
    {
        $message = new AnonymousMessages();

        if ($message->save()) {
            Redirect::back()->with('message', 'message successfully sent')->with('alertclass', 'alert-success');
        }
        return Redirect::to(route('contact') . '#msg-link')->withErrors($message->errors())->withInput();
    }

}