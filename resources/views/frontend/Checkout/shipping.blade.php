@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp;&middot;&nbsp;Checkout</title>
@stop
@section('top-bar')
    @include('layouts.frontend.sections.navigation.top-navbar')
@show
@section('main-nav')

@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container checkout-wizard">

        @include('_partials.modals.Checkout.editGuestInfo', ['elementID' => 'shippingInfoModal'])
        <div class="row bs-wizard" style="border-bottom:0;">
            @include('_partials.Checkout.checkout-progress.step1', ['state' => 'complete'])
            @include('_partials.Checkout.checkout-progress.step2', ['state' => 'active'])
            @include('_partials.Checkout.checkout-progress.step3')
            @include('_partials.Checkout.checkout-progress.step4')
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

                        <table class="table table-bordered">
                            <tr>
                                <th class="bold">User Name:</th>
                                <td>{{ beautify($guest->first_name . " ". $guest->last_name) }}</td>
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


                        <button class="btn btn-primary" data-toggle="modal" data-target="#shippingInfoModal"><i
                                    class="fa fa-edit"></i>&nbsp;Edit this information
                        </button>
                        <hr/>
                        <div class="alert alert-info">
                            <h4>Your Item(s):</h4>
                        </div>

                        <p><i class="fa fa-info-circle checkout-info"></i>&nbsp;You will get an opportunity to modify your products, at the Order page</p>


                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="bold">Product Name</th>
                                <th class="bold">Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $cart->getSingleProductQuantity($product) }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>


                        <hr/>
                        <div class="alert alert-info">
                            <h4>Shipping method:</h4>
                        </div>
                        <div class="well">
                            <p class="bold">In home delivery
                                to {{ $guest->home_address }}: <span
                                        class="text-info">{{  $cart->getShippingSubTotal() }}</span></p>

                            <p class="text-info">{{ $cart->productShippingCostNotAvailable() ? "Shipping is free for this item(s)" : "Shipping is not free for this item(s)"}}</p>
                        </div>
                        <hr/>
                        <div class="alert alert-info">
                            <h4>Product delivery:</h4>
                        </div>
                        <p><i class="fa fa-info-circle checkout-info"></i>&nbsp;We will contact you via your phone number, <span class="bold">{{ $guest->phone }}</span> to
                            schedule delivery of your items</p>

                        <hr/>
                        <div class="m-t-10">
                            <a href="{{ route('checkout.step2') }}">
                                <button class="btn btn-warning pull-left disabled">
                                    <i class="fa fa-arrow-left"></i>&nbsp;Back to billing Address
                                </button>
                            </a>
                            <a href="{{ route('checkout.step3') }}">
                                <button class="btn btn-success pull-right">
                                    Proceed to payment page&nbsp;<i class="fa fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2 pull-right shipping-info">
                    @include('_partials.forms.orders.order-summary')
                </div>
            </div>
        </div>
    </div>

@stop
@section('brands')

@stop
@section('footer')
    @include('layouts.frontend.sections.footer.footer-basic')
@stop