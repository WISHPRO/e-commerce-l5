@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>View Shopping cart</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container">
        <h1>Your Shopping cart</h1>
        <hr/>
        @include('_partials.Checkout.displayCheckoutButton')
        <div class="row m-b-20 wow fadeInUp animated">
            <div class="col-md-12 m-b-20">
                <table class="table table-bordered table-responsive table-condensed products-in-cart">

                    <thead>
                    <tr>
                        <th>
                            <h4>Image</h4>
                        </th>
                        <th>
                            <h4>Name</h4>
                        </th>
                        <th>
                            <h4>Qty</h4>
                        </th>
                        <th>
                            <h4>Price</h4>
                        </th>
                        <th>
                            <h4>Total</h4>
                        </th>
                        <th>
                            <h4>
                                Actions
                            </h4>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                    <img src="{{ displayImage($product) }}" class="img-responsive small-image">
                                </a>

                            </td>
                            <td>
                                <p class="name">
                                    <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                        {{ $product->name }}
                                    </a>
                                </p>
                                <p class="text text-primary bold">SKU:&nbsp;{{ $product->sku }}</p>
                                <br/>
                                <p>Shipping mode: <a href="#" data-target="#helpWithShippingModes" data-toggle="modal">standard</a></p>
                                <p>
                                    Product arrives in: 1-3 business days&nbsp;&nbsp;.
                                </p>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', ['id' => $product->id]) }}"
                                      class="form-horizontal updateCart" role="form">
                                    <input type="hidden" name="_method" value="PATCH">
                                    {!! generateCSRF() !!}
                                    <input name="quantity" type="number"
                                           value="{{ $cart->getSingleProductQuantity($product) }}"
                                           min="1" max="{{ $product->quantity }}" class="form-control pull-left"
                                           style="width: 70px" required>
                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                    <button class="btn btn-info btn-sm pull-right" type="submit"
                                            data-toggle="tooltip" data-placement="top" data-original-title="update cart"
                                            style="margin-top: 2px">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </form>

                            </td>
                            <td>
                                {{ $product->getPriceAfterDiscount() }}
                            </td>

                            <td>
                                <p class="bold">{{ formatMoneyValue($product->value($product, $cart->getSingleProductQuantity($product))) }}</p>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update.remove', ['id' => $product->id]) }}"
                                      class="form-horizontal removeFromCart">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {!! generateCSRF() !!}
                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip"
                                            data-placement="top" data-original-title="remove from cart">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <hr/>
            <div class="col-md-4 m-b-10">
                <p>Do you have a promotional code? Redeem it here</p>
                @include('_partials.Checkout.payment.redeem-promo')
            </div>
            <div class="col-md-5 col-md-offset-3 m-b-10">
                <table class="table table-bordered">
                    <tr>
                        <th class="bold">Total cost:</th>
                        <td>{{ $cart->getCartSubTotal()  }}</td>
                    </tr>
                    <tr>
                        <th class="bold">Shipping & handling:</th>
                        <td>{{ $cart->getShippingSubTotal() }}</td>
                    </tr>
                    <tr>
                        <th>
                            <h4 class="bold">
                                Estimated order total:
                            </h4>
                        </th>
                        <td>
                            <h4>{{ $cart->getIntermediateCost() }}&nbsp;<span class="text text-info order-total-msg">(before tax)</span></h4>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <hr/>
        @include('_partials.Checkout.displayCheckoutButton')
        <h2>View more products below</h2>
        <section class="section wow fadeInUp animated m-b-20">
            <h2 class="section-title">Featured Tablets</h2>

            @include('_partials.data.home-page.featured-products', ['data' => $featuredTablets])
        </section>
        @include('_partials.modals.help.helpWithShippingInfo')
    </div>
@stop