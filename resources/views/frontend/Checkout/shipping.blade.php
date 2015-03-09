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
        <div class="modal fade" id="shippingInfoModal" tabindex="-1" role="dialog"
             aria-labelledby="shippingInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="infoModalLabel">Edit shipping Address</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="{{ route('checkout.step1.edit') }}" method="POST" id="shippingInfo">
                                <input type="hidden" name="_method" value="PATCH">
                                {!! generateCSRF() !!}
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <p>Modify fields needed and then press the save button</p>
                                    <hr/>
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                               maxlength="20"
                                               placeholder="Enter your first name"
                                               value="{{ old('first_name') == null ? $guestInfo->implode('first_name') : old('first_name') }}"
                                               required>
                                        @if($errors->has('first_name'))
                                            <span class="error-msg">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Second Name:</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                               maxlength="20"
                                               placeholder="Enter your second name"
                                               value="{{ old('last_name') == null ? $guestInfo->implode('last_name') : old('last_name') }}"
                                               required>
                                        @if($errors->has('last_name'))
                                            <span class="error-msg">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="county_id">Select your county:</label>
                                        {!! Form::select('county_id', str_replace('_', ' ', App\Models\County::lists('name', 'id')), null,  [ 'class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="town">Your Hometown: </label>
                                        <input type="text" id="town" name="town" class="form-control" maxlength="20"
                                               placeholder="e.g karen, muthaiga, langata..." required
                                               value="{{ old('town') == null ? $guestInfo->implode('town') : old('town') }}">
                                        @if($errors->has('town'))
                                            <span class="error-msg">{{ $errors->first('town') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="home_address">Your Home Address (where you live):</label>
                                <textarea id="home_address" name="home_address" rows="4"
                                          placeholder="home address, apartment,house number, etc" maxlength="100"
                                          required
                                          class="form-control">{{ old('home_address')== null ? $guestInfo->implode('home_address') : old('home_address') }}</textarea>
                                        @if($errors->has('home_address'))
                                            <span class="error-msg">{{ $errors->first('home_address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Your Phone number:</label>

                                        <div class="input-group">
                                            <span class="input-group-addon">+254</span>
                                            <input type="text" id="phone" name="phone" placeholder="712345678"
                                                   maxlength="9" required
                                                   value="{{ old('phone') == null ? $guestInfo->implode('phone') : old('phone') }}"
                                                   class="form-control">
                                        </div>
                                        @if($errors->has('phone'))
                                            <span class="error-msg">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email Address:</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               placeholder="Enter email address"
                                               value="{{ old('email') == null ? $guestInfo->implode('email') : old('email') }}"
                                               required>
                                        @if($errors->has('email'))
                                            <span class="error-msg">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <hr/>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Save New details
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bs-wizard" style="border-bottom:0;">
            @include('_partials.checkout-progress.step1', ['state' => 'complete'])
            @include('_partials.checkout-progress.step2', ['state' => 'active'])
            @include('_partials.checkout-progress.step3')
            @include('_partials.checkout-progress.step4')
        </div>
        <hr/>
        <div class="row" id="step-2">
            <div class="col-md-12">
                <h3>Shipping information</h3>

                <div class="col-md-6 m-b-10">
                    <div class="row shipping-info">
                        <div class="alert alert-info">
                            <h4>Ship Items to:</h4>
                        </div>
                        <div class="well">
                            @if(empty(\Cookie::get( 'g_c' )))

                            @else

                                @foreach($guestInfo as $guest)
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="bold">User Name:</th>
                                            <td>{{ beautify($guest->getUserName()) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bold">County:</th>
                                            <td>{{ beautify($guest->county->name) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bold">Hometown:</th>
                                            <td>{{ beautify($guest->town) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bold">Home Address:</th>
                                            <td>{{ beautify($guest->home_address) }}</td>
                                        </tr>
                                    </table>
                                @endforeach
                            @endif
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#shippingInfoModal"><i
                                    class="fa fa-edit"></i>&nbsp;Edit this information
                        </button>
                        <hr/>
                        <div class="alert alert-info">
                            <h4>Item(s):</h4>
                        </div>
                        <div class="well">
                            <p>You will get an opportunity to modify your products, at the Order page</p>
                            @foreach($cartItems as $cart)
                                @foreach($cart->products as $product)
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="bold">Product Name</th>
                                            <th class="bold">Quantity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ beautify($product->name) }}</td>
                                            <td>{{ $cart->getSingleProductQuantity($product) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            @endforeach
                        </div>
                        <hr/>
                        <div class="alert alert-info">
                            <h4>Shipping method:</h4>
                        </div>
                        <div class="well">
                            <p class="bold">In home delivery
                                to {{ isset($guestInfo) ? $guestInfo->implode('home_address') : "" }}: ksh 0</p>

                            <p class="text-info">Shipping is free for this item(s)</p>
                        </div>
                        <hr/>
                        <div class="alert alert-info">
                            <h4>Product delivery:</h4>
                        </div>
                        <p>We will contact you to schedule delivery of your items</p>

                        <div class="m-t-10">
                            <a href="{{ route('checkout.step2') }}">
                                <button class="btn btn-warning pull-left disabled">
                                    Back to billing Address
                                </button>
                            </a>
                            <a href="{{ route('checkout.step3') }}">
                                <button class="btn btn-primary pull-right">
                                    Proceed to payment page
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2 pull-right shipping-info">
                    <h3>Order summary (Ksh)</h3>
                    @foreach($cartItems as $cart)
                        @foreach($cart->products as $product)
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bold">Products:</th>
                                    <td>{{ $cart->getProductPrice($product)  }}</td>
                                </tr>
                                <tr>
                                    <th class="bold">Shipping & handling:</th>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th class="bold">Tax (VAT):</th>
                                    <td>{{ $product->calculateTax() }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <h4 class="bold">
                                            Order total
                                        </h4>
                                    </th>
                                    <td>
                                        <h4 class="bold">
                                            {{ $cart->getSubTotal(true) }}
                                        </h4>
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('layouts.frontend.sections.footer.footer-basic')

@stop

@section('footer')

@stop