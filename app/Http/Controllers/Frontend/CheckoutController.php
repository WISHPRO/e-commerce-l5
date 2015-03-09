<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GuestCheckoutRequest;
use app\Models\Checkout;
use app\Models\Guest;
use app\Models\User;
use Response;

class CheckoutController extends Controller
{
    // step Identifier. numbers range from 1 to 4, depending on the checkout method
    protected $stepID = null;

    // state of a user's progress in the checkout
    protected $stepState = "active";

    /**
     * checkout authentication
     *
     * @return Response
     */
    public function auth()
    {
        return view( 'frontend.Checkout.auth' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Step 1 of 4
     *
     * Allow guest users to submit their personal info
     *
     * @return Response
     */
    public function guestInfo()
    {
        $this->stepID = 1;

        if ( ! \Auth::check()) {
            return view( 'frontend.Checkout.guest' );

        } else {
            // skip step 1. return a view that will allow the user to modify their shipping info
            return redirect()->route( 'checkout.step2' );
        }
    }

    /**
     * Saving guest Information
     *
     * @param \App\Http\Requests\GuestCheckoutRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postGuestInfo( GuestCheckoutRequest $request )
    {
        $this->stepID = 1;

        $guest = Guest::firstOrCreate( $request->except('_token', 'guest') );

        if (empty( $guest )) {
            flash()->error(
                'Form submission failed. Please try again'
            );

            return redirect()->back();
        }

        flash()->success(
            'Action was a success'
        );

        $this->stepState = 'complete';

        $progressCookie = $guest->makeProgressCookie(
            [ 'step'         => $this->stepID,
              'state'        => $this->stepState,
              'progressData' => $guest
            ]
        );

        return redirect()->route( 'checkout.step2' )->withCookies(
            [$guest->makeGuestCookie( $guest->id ), $progressCookie]
        );
    }

    /**
     * Step 2 of 4
     *
     * Allow users and guests to view and edit their shipping information
     *
     * @return Response
     */
    public function shipping()
    {
        $this->stepID = 2;

        if (empty( \Cookie::get( 'g_c' ) ))
        {
            return redirect()->route('checkout.auth');
        }
        $guestInfo = Guest::with('county')->whereId(\Cookie::get('g_c'))->get();

        return view( 'frontend.Checkout.shipping' , compact('guestInfo'));
    }

    /**
     * Allow guest users to edit their shipping information in place. Still step 2
     *
     * @param                                         $id
     * @param \App\Http\Requests\GuestCheckoutRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editShippingAddress($id, GuestCheckoutRequest $request)
    {
        $guest = Guest::find($id);

        if($guest->update($request->except('_token', 'guest')) == 1)
        {
            flash('Information was successfully updated');

            return redirect()->back();
        }
        flash()->error('An error occured. Please try again later');

        return redirect()->back();
    }

    public function payment()
    {
        $this->stepID = 3;
    }

    public function modifyPaymentInfo()
    {

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
