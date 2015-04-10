<?php namespace App\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\Checkout\CheckOutSteps;
use app\Antony\DomainLogic\Modules\Checkout\Guest\GuestBegin;
use app\Antony\DomainLogic\Modules\Checkout\Shipping\ShippingStep;
use App\Antony\DomainLogic\modules\Cookies\CheckoutCookie;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use App\Antony\DomainLogic\modules\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Checkout\GuestCheckoutRequest;
use App\Models\Guest;
use Illuminate\Contracts\Auth\Guard;
use Response;

class AuthUserCheckoutController extends Controller
{
    public function __construct(){

    }
}
