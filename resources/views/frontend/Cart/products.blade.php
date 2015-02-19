@extends('layouts.frontend.master')

@section('head')
    @parent
    {!! HTML::style('assets/css/vendor/bootstrap/bootstrap-rating.css') !!}
    <title>View Shopping cart</title>

@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container">
        @foreach($items as $cart)
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:40%">Product</th>
                <th style="width:15%">Price</th>
                <th style="width:10%">Quantity</th>
                <th style="width:20%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>

                @foreach($cart->products as $product)
            <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ displayImage($product) }}" class="img-responsive"/>
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">
                                    <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                        {{ beautify($product->name) }}
                                    </a>
                                </h4>
                                <p>{!! $product->description_short !!}</p>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">
                        @if(!hasDiscount($product))
                            <span class="price">
                                                         <span class="curr-sym">Ksh</span>
                                {{ $product->price }}
                                                        </span>
                        @else

                            <span class="price">
                                <span class="price-strike">
                                                            <span class="curr-sym">Ksh</span>
                                    {{ $product->price }}
                                                        </span>
                                                         <span class="curr-sym">Ksh</span>
                                {{ calculateDiscount($product, true)}}
                                                        </span>

                            <div class="savings">
                                You save: {{ $product->discount }} &percnt;
                            </div>
                        @endif

                    </td>
                    <td data-th="Quantity">
                       <input name="quantity" type="number" value="{{ getCartPQt($product) }}" min="1" max="{{ $product->quantity }}" class="form-control" style="width: 80px">
                    </td>
                    <td data-th="Subtotal" class="text-center"><span class="curr-sym">Ksh</span>&nbsp;{{ getProductPrice($product) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </td>

            </tr>
                @endforeach


            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>{{ getCartSubTotal($cart) }}</strong></td>
            </tr>
            <tr>
                <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>{{ getCartSubTotal($cart) }}</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>
        @endforeach
    </div>
@stop