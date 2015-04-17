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

    <div class="container">
        <div class="row m-t-20">
            <div class="col-md-12 m-b-20">
                <h1>Your products</h1>

                <p>Review your order below, then press the submit order button when ready</p>
                <hr/>
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
                                <a href="#">
                                    <img src="{{ display_img($product) }}" class="img-responsive small-image">
                                </a>

                            </td>
                            <td>
                                <p class="name">
                                    <a href="{{ route('product.view', ['product' => $product->id, ]) }}"
                                       target="_blank">
                                        {{ $product->name }}
                                    </a>
                                </p>

                                <p class="text text-primary bold">SKU:&nbsp;{{ $product->sku }}</p>
                                <br/>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', ['product' => $product->id]) }}"
                                      class="form-horizontal updateCart" role="form">
                                    <input type="hidden" name="_method" value="PATCH">
                                    {!! csrf_html() !!}
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
                                <p class="bold">{{ format_money($product->value($product, $cart->getSingleProductQuantity($product))) }}</p>
                            </td>
                            <td>
                                <form method="POST"
                                      action="{{ route('cart.update.remove', ['product' => $product->id]) }}"
                                      class="form-horizontal removeFromCart">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {!! csrf_html() !!}
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
            <div class="col-md-4 col-md-offset-2 pull-right shipping-info">
                @include('_partials.forms.orders.order-summary')
                {!! Form::open(['url' => route($is_logged_in ? 'u.checkout.submitOrder' : 'checkout.submitOrder')]) !!}
                <button class="btn btn-primary" type="submit">
                    place order
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('brands')

@stop
@section('footer')
    @include('layouts.frontend.sections.footer.footer-basic')
@stop