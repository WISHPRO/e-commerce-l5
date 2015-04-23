@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>View Shopping cart</title>
@stop

@section('slider')

@stop

@section('content')
    <div class="container">
        <div class="row m-b-20 ">
            <h1>Your Shopping cart <span class="text text-info text-small">[{{ $cart->getAllProductsQuantity() > 1 ? $cart->getAllProductsQuantity() .' '. str_plural('item') : $cart->getAllProductsQuantity() .' '. str_singular('items') }}]</span> </h1>
            <hr/>
            @include('_partials.Checkout.displayCheckoutButton')
            <div class="col-md-12 m-b-20">
                <p class="bold">All prices are inclusive of a {{ config('site.products.VAT', .16) * 100 }} &percnt; VAT
                    charge</p>
                <table class="table table-bordered table-responsive table-condensed products-in-cart">

                    <thead>
                    <tr>
                        <th>
                            <h4>Product</h4>
                        </th>
                        <th>
                            <h4>Description</h4>
                        </th>
                        <th>
                            <h4>Qty</h4>
                        </th>
                        <th>
                            <h4>Price</h4>
                        </th>
                        <th>
                            <h4>VAT
                                <br/><span class="text-small">(already included in price)</span> </h4>
                        </th>
                        <th>
                            <h4>Total</h4>
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('product.view', ['product' => $product->id, ]) }}">
                                    <img src="{{ display_img($product) }}" class="img-responsive small-image">
                                </a>

                            </td>
                            <td>
                                <p class="name">
                                    <a href="{{ route('product.view', ['product' => $product->id, ]) }}">
                                        {{ $product->name }}
                                    </a>
                                </p>

                                <p class="text text-primary bold">SKU:&nbsp;{{ $product->sku }}</p>
                                <br/>

                                <p>Shipping mode: <a href="#" data-target="#helpWithShippingModes" data-toggle="modal">standard</a>
                                </p>

                                <p>
                                    Product arrives in: 1-3 business days&nbsp;&nbsp;.
                                </p>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', ['product' => $product->id]) }}"
                                      class="form-horizontal updateCart" role="form">
                                    <input type="hidden" name="_method" value="PATCH">
                                    {!! Form::token() !!}
                                    <input name="quantity" type="number"
                                           value="{{ $cart->getSingleProductQuantity($product) }}"
                                           min="1" max="{{ $product->quantity }}" class="form-control pull-left"
                                           style="width: 70px" required>
                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                    <button class="btn btn-primary btn-sm pull-right" type="submit"
                                            data-toggle="tooltip" data-placement="top" data-original-title="update product quantity"
                                            style="margin-top: 2px">
                                        <i class="glyphicon glyphicon-refresh"></i>
                                    </button>
                                </form>

                            </td>
                            <td>
                                <p>{{ format_money($product->total()) }}</p>
                            </td>
                            <td>
                                <p>{{ format_money($product->tax()) }}</p>
                            </td>
                            <td>
                                <p class="bold">{{ format_money($product->quantity($cart->getSingleProductQuantity($product))->total()) }}</p>
                            </td>
                            <td>
                                <form method="POST"
                                      action="{{ route('cart.update.remove', ['product' => $product->id]) }}"
                                      class="form-horizontal removeFromCart">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {!! Form::token() !!}
                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip"
                                            data-placement="top" data-original-title="remove product from cart">
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
                <p>Do you have a voucher/promotional code? Redeem it here</p>
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
                            <h4>
                                {{ $cart->getGrandTotal() }}
                            </h4>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <hr/>
        @include('_partials.Checkout.displayCheckoutButton')
        <h2>View more products below</h2>
        <section class="section m-b-20 ">
            <h2 class="section-title">Featured Tablets</h2>

            @include('_partials.data.home-page.featured-products', ['data' => $featuredTablets])
        </section>
        @include('_partials.modals.help.helpWithShippingInfo')
    </div>
@stop