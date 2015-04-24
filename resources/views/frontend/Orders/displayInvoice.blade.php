@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp;&middot;&nbsp;View Invoice</title>
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
    <div class="container-fluid">
        <div class="inner-xs" id="user-invoice">
            <div class="row">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="invoice-title">
                        <h2>Your Invoice</h2>

                        <h3 class="pull-right">Order # {{ $order->id }}</h3>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Invoice Billed To:</strong>

                                <p>{{ $user->getUserName() }}</p>

                                <p>Location: {{ $user->county->name }}, {{ $user->town }} town - {{ $user->home_address }}
                                </p>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Products Shipped To:</strong><br>

                                <p>{{ $user->getUserName() }}</p>

                                <p>Location: {{ $user->county->name }}, {{ $user->town }} town - {{ $user->home_address }}
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Payment Method:</strong><br>

                                <p class="text text-info">#This is a test invoice. You did not pay for the product</p> <br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{ $order->created_at }}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                    <tr>
                                        <td><strong>Item</strong></td>
                                        <td class="text text-center"><strong>Description</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-center"><strong>Discount</strong></td>
                                        <td class="text-center"><strong>VAT</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cart_data->products as $product)
                                        <tr>
                                            <td>{{ '#' . $product->sku }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td class="text-center">{{ format_money($product->value()) }}</td>
                                            <td class="text-center">{{ format_money($product->discount()) }}</td>
                                            <td class="text-center">{{ format_money($product->tax()) }}</td>
                                            <td class="text-center">{{ $product->pivot->quantity }}</td>
                                            <td class="text-right"><p class="bold">{{ format_money($product->quantity($cart_data->getSingleProductQuantity($product))->total()) }}</p></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">{{ $cart_data->getCartSubTotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Shipping</strong></td>
                                        <td class="no-line text-right">{{ $cart_data->getShippingSubTotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">{{ $cart_data->getGrandTotal() }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="pull-right">
            <a href="{{ route('home') }}">
                <button class="btn btn-primary">
                    Continue shopping
                </button>

            </a>
        </div>

    </div>
@stop

@section('brands')

@stop
@section('footer')
    @include('layouts.frontend.sections.footer.footer-basic')
@stop