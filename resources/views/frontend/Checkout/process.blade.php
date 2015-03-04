@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp;&middot;&nbsp;Checkout</title>
@stop

@section('main-nav')

@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container checkout-wizard">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Billing Address</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-primary btn-circle" >2</a>
                    <p>Shipping information</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-primary btn-circle" >3</a>
                    <p>Payment</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-primary btn-circle" >3</a>
                    <p>Place order</p>
                </div>
            </div>
        </div>

            <div class="row setup-content" id="step-1">
                <div class="row">
                    <form action="{{ route('registration.store') }}" method="POST" id="guestCheckoutForm">
                        {!! generateCSRF() !!}
                        <div class="col-md-5 col-md-offset-1 col-xs-12">
                            <h3>Please fill in this form</h3>
                            <p>All fields are required</p>
                            <hr/>
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" maxlength="20"
                                       placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                                @if($errors->has('first_name'))
                                    <span class="error-msg">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="last_name">Second Name:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" maxlength="20"
                                       placeholder="Enter your second name" value="{{ old('last_name') }}" required>
                                @if($errors->has('last_name'))
                                    <span class="error-msg">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="county_id">Select your county:</label>
                                <p class="text text-help text-info">currently, we only ship products to the counties listed below</p>
                                {!! Form::select('county_id', str_replace('_', ' ', App\Models\County::lists('name', 'id')), null,  [ 'class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="town">Your Hometown: </label>
                                <span class="text text-help text-info">Ensure that your town exists in the county you've selected</span>
                                <input type="text" id="town" name="town" class="form-control" maxlength="20"
                                       placeholder="e.g karen, muthaiga, langata..." required>
                                @if($errors->has('town'))
                                    <span class="error-msg">{{ $errors->first('town') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="home_address">Your Home Address (where you live):</label>
                                <span class="text text-help text-info">We need to know where exactly we will ship your product</span>
                                <textarea id="home_address" name="home_address" rows="4"
                                          placeholder="home address, apartment,house number, etc" maxlength="100" required
                                          class="form-control">{{ old('home_address') }}</textarea>
                                @if($errors->has('home_address'))
                                    <span class="error-msg">{{ $errors->first('home_address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Your Phone number:</label>
                                <span class="text text-help text-info">We might need to contact you about your product.</span>
                                <div class="input-group">
                                    <span class="input-group-addon">+254</span>
                                    <input type="text" id="phone" name="phone" placeholder="712345678" maxlength="9" required
                                           value="{{ old('phone') }}" class="form-control">
                                </div>
                                @if($errors->has('phone'))
                                    <span class="error-msg">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email Address:</label>
                                <span class="text text-help text-info">We shall send your receipt to this address</span>
                                <input type="email" id="email" name="email" class="form-control"
                                       placeholder="Enter email address" value="{{ old('email') }}" required>
                                @if($errors->has('email'))
                                    <span class="error-msg">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="field-row form-group">
                                <p class="text text-help text-info">Checking this box below implies that we shall ship products to your home address. You can change this later, e.g if you want a product to be shipped elsewhere</p>
                                <input type="checkbox" name="s-confirm">
                                <span>Shipping address is same as my home address</span>
                                <br/>
                            </div>

                            <button class="btn btn-primary btn-lg nextBtn">
                                Continue to shipping page
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3>Shipping information</h3>
                        <div class="col-md-6 m-b-10">
                            <div class="row shipping-info">
                                <div class="alert alert-info">
                                    <h4>Ship Items to:</h4>
                                </div>
                                <div class="well">
                                    <p class="bold">User Name: firstname lastname</p>
                                    <p class="bold">County:</p>
                                    <p class="bold">Hometown:</p>
                                    <p class="bold">Home address:</p>
                                </div>
                                <button class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit this address</button>
                                <hr/>
                                <div class="alert alert-info">
                                    <h4>Item(s):</h4>
                                </div>
                                <div class="well">
                                    <p class="bold">Item Name</p>
                                    <p>QTy: 1</p>
                                    <p class="bold">Item Name</p>
                                </div>
                                <hr/>
                                <div class="alert alert-info">
                                    <h4>Shipping method:</h4>
                                </div>
                                <div class="well">
                                    <p class="bold">In home delivery to address: ksh 0</p>
                                    <p class="text-info">Shipping is free for this item</p>
                                </div>
                                <hr/>
                                <div class="alert alert-info">
                                    <h4>Product delivery:</h4>
                                </div>
                                <p>We will contact you to schedule delivery of your items</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2 pull-right shipping-info">
                            <h3>Order summary</h3>
                            <p class="bold">Products: ksh 0.0</p>
                            <p class="bold">Shipping and handling: ksh 0.0</p>
                            <p class="bold">Tax: ksh 0.0</p>
                            <hr/>
                            <h4 class="bold">Order Total: ksh 0.0</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <h3>Payment information</h3>
                        <div class="col-md-6 m-b-10">
                            <div class="row shipping-info">
                                <div class="alert alert-info">
                                    <h4>Ship Items to:</h4>
                                </div>
                                <div class="well">
                                    <p class="bold">User Name: firstname lastname</p>
                                    <p class="bold">County:</p>
                                    <p class="bold">Hometown:</p>
                                    <p class="bold">Home address:</p>
                                    <p class="bold">Email address:</p>
                                </div>
                                <button class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit this information</button>
                                <hr/>
                                <div class="alert alert-info">
                                    <h4>Payment:</h4>
                                    <p>Use any of the payment methods below</p>
                                </div>
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#paymentReward" aria-expanded="false" aria-controls="paymentReward">
                                    Redeem promo code / voucher
                                </button>
                                <div class="collapse m-t-10" id="paymentReward">
                                    <div class="well">
                                        <form class="form-inline m-b-15">
                                            <div class="form-group">
                                                <label for="promoCode">Promo code:&nbsp;</label>
                                                <input type="text" class="form-control" id="promoCode">
                                            </div>
                                            &nbsp;
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                        </form>
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label for="voucherCode">Voucher code:</label>
                                                <input type="text" class="form-control" id="voucherCode">
                                            </div>
                                            &nbsp;
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                        </form>
                                    </div>
                                </div>
                                <hr/>
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#paymentMPESA" aria-expanded="false" aria-controls="paymentMPESA">
                                    Pay via M-PESA
                                </button>
                                <div class="collapse m-t-10" id="paymentMPESA">
                                    <div class="well">
                                        <p>Hii mpesa hudu aje online? mi sijui</p>
                                    </div>
                                </div>
                                <hr/>

                                <h4>Pay with Credit/Debit Card</h4>

                                <div class="m-t-10" id="paymentVisa">
                                    <div class="well">
                                        <div class="form-group">
                                            <label for="cardNo">Enter card Number:</label>
                                            <input type="text" id="cardNo" name="cardNo" required class="form-control">
                                        </div>
                                    </div>
                                    <p>We support the following payment methods</p>
                                    <div>
                                        <i class="fa fa-cc-stripe fa-2x" title="stripe"></i>
                                        <i class="fa fa-cc-visa fa-2x" title="visa"></i>
                                        <i class="fa fa-cc-paypal fa-2x" title="paypal"></i>
                                        <i class="fa fa-google-wallet fa-2x" title="google wallet"></i>
                                        <i class="fa fa-cc-mastercard fa-2x" title="mastercard"></i>
                                    </div>
                                </div>
                                <hr/>
                                <button class="btn btn-primary btn-lg">Proceed to order review page</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2 pull-right shipping-info">
                            <h3>Order summary</h3>
                            <p class="bold">Products: ksh 0.0</p>
                            <p class="bold">Shipping and handling: ksh 0.0</p>
                            <p class="bold">Tax: ksh 0.0</p>
                            <hr/>
                            <h4 class="bold">Order Total: ksh 0.0</h4>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row m-t-30 checkout-footer">
            <div class="col-md-4 p-all-10">
                <p>
                    <a href="#" data-toggle="modal" data-target="#infoModal">
                        <i class="fa fa-lock help-glyph fa-2x"></i>&nbsp;Checkout is always safe and secure
                    </a>
                </p>
                <br/>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('cart.view') }}">Your cart</a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}">Terms of use</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 p-all-10">
                &copy; PC World {{ date('Y') }}
            </div>
        </div>
    </div>
    @include('_partials.modals.secure-message')
@stop

@section('footer')

@stop

