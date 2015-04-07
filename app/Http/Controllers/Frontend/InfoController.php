<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Contact\Base\AnonymousMessages;
use app\Antony\DomainLogic\Modules\Contact\ContactMessageRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ContactMessage\ContactMessageRequest;

class InfoController extends Controller
{

    /**
     * @var ContactMessageRepo
     */
    private $msg;

    /**
     * @param AnonymousMessages $contactMessageRepo
     */
    public function __construct(AnonymousMessages $contactMessageRepo)
    {

        $this->msg = $contactMessageRepo;
    }

    /**
     * Display the about page
     *
     * @return \Illuminate\View\View
     */
    public function getAbout()
    {
        return view('frontend.Info.about');
    }


    /**
     * Display the terms of agreement page
     *
     * @return \Illuminate\View\View
     */
    public function getTerms()
    {
        return view('frontend.Info.policy');
    }


    /**
     * Display the contact page
     *
     * @return \Illuminate\View\View
     */
    public function getContact()
    {
        return view('frontend.Info.contact');
    }

    /**
     * Save a contact message
     *
     * @param ContactMessageRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postContactMessage(ContactMessageRequest $request)
    {
        $this->msg->send($request->except("_session, g-recaptcha-response"))->handleRedirect($request);
    }

}
