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

        <div class="row bs-wizard" style="border-bottom:0;">
            @include('_partials.checkout-progress.step1', ['state' => 'active'])
            @include('_partials.checkout-progress.step2')
            @include('_partials.checkout-progress.step3')
            @include('_partials.checkout-progress.step4')
        </div>
        <div class="row" id="step-1">
            <div class="row">
                <form action="{{ route('checkout.step1.store', ['guest' => 1]) }}" method="POST" id="guestCheckoutForm">
                    {!! generateCSRF() !!}
                    <div class="col-md-5 col-md-offset-1 col-xs-12">
                        <h3>Guest checkout. Billing Address</h3>

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

                            <p class="text text-help">currently, we only ship products to the counties listed
                                below</p>
                            {!! Form::select('county_id', str_replace('_', ' ', App\Models\County::lists('name', 'id')), null,  [ 'class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="town">Your Hometown: </label>
                            <span class="text text-help">Ensure that the town exists in the county you've selected</span>
                            <input type="text" id="town" name="town" class="form-control" maxlength="20"
                                   placeholder="e.g karen, muthaiga, langata..." required>
                            @if($errors->has('town'))
                                <span class="error-msg">{{ $errors->first('town') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="home_address">Your Home Address (where you live):</label>
                                <textarea id="home_address" name="home_address" rows="4"
                                          placeholder="home address, apartment,house number, etc" maxlength="100"
                                          required
                                          class="form-control">{{ old('home_address') }}</textarea>
                            @if($errors->has('home_address'))
                                <span class="error-msg">{{ $errors->first('home_address') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Your Phone number:</label>

                            <div class="input-group">
                                <span class="input-group-addon">+254</span>
                                <input type="text" id="phone" name="phone" placeholder="712345678" maxlength="9"
                                       required
                                       value="{{ old('phone') }}" class="form-control">
                            </div>
                            @if($errors->has('phone'))
                                <span class="error-msg">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email Address:</label>
                            <span class="text text-help">We shall send your receipt to this address</span>
                            <input type="email" id="email" name="email" class="form-control"
                                   placeholder="Enter email address" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="error-msg">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">
                            Continue to shipping page
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('footer')
@stop