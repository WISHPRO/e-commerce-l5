<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Contracts\Contact\ContactMessageContract as Status;
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
     * @param ContactMessageRepo $contactMessageRepo
     */
    public function __construct(ContactMessageRepo $contactMessageRepo)
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
        $response = $this->msg->send($request->except("_session, g-recaptcha-response"));

        switch ($response) {

            case status::MESSAGE_SENT: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Your message was successfully sent'], 200);
                }
                flash('Your message was successfully sent');
                return redirect()->back();
            }

            case status::MESSAGE_NOT_SENT: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Oops!. Your message was not sent. Please try again'], 422);
                }
                flash()->error('Oops!. Your message was not sent. Please try again');
                return redirect()->back()->withInput($request->all());
            }

        }
    }

}
