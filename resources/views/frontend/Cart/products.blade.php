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

        <p>Review your items below. Change them as needed, and when ready, just press the 'checkout' button</p>

        <div class="row">
            <div class="col-md-12 m-b-20">
                <table class="table table-bordered table-responsive table-striped table-condensed table-hover">

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
                            <h4>SubTotal (Qty x price)</h4>
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
                                    <img src="{{ displayImage($product) }}" class="img-responsive"
                                         style="height: 50px; width: 50px">
                                </a>

                            </td>
                            <td>
                                <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                    {{ str_limit($product->name, 75) }}
                                </a>

                                <br/>
                                <span class="text text-primary bold">SKU:&nbsp;</span> {{ $product->sku }}
                                <br/>
                                <ul class="force-list-style">{!! str_limit($product->description_short, 500) !!}</ul>

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
                                {{ formatMoneyValue($product->value($product, $cart->getSingleProductQuantity($product))) }}
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
            <div class="col-md-4 col-md-offset-8 m-b-10">
                <h4 class="pull-right">
                    Total: {{ $cart->getCartSubTotal() }} <span class="text text-info"
                                                            style="font-style: italic; font-size: 11px">(VAT not inclusive)</span>
                </h4>
            </div>

        </div>
        <hr/>
        <div class="row m-b-20">
            <div class="col-md-4 col-md-offset-8 m-b-10">
                <a href="{{ route('checkout.step1') }}">
                    <button class="btn btn-success pull-right">
                        Proceed to checkout &nbsp;<i class="fa fa-arrow-right"></i>
                    </button>
                </a>

            </div>
        </div>
        <section class="section wow fadeInUp animated m-b-20">
            <h2 class="section-title">Featured Tablets</h2>

            @include('_partials.data.home-page.featured-products', ['data' => $featuredTablets])
        </section>
    </div>
@stop