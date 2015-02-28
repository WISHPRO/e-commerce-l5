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

        <p>To continue shopping, just press the 'continue shopping' button below</p>
        @foreach($cartItems as $cart)
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:40%">Product</th>
                <th style="width:15%">Price</th>
                <th style="width:15%">Quantity</th>
                <th style="width:20%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>

                @foreach($cart->products as $product)
                    <tr class="success">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ displayImage($product) }}" class="img-responsive">
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">
                                    <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                        {{ beautify($product->name) }}
                                    </a>
                                    <?php $reviewCount = $product->getReviewCount(); ?>
                                    @if(is_null($reviewCount))
                                        <div class="row m-t-5">
                                            <div class="col-sm-12">
                                                <div class="rating rateit-small rateit">
                                                    <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                                    <span class="text text-info">(Not rated Yet)</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    @else
                                        <div class="row m-t-5">
                                            <div class="col-sm-12">
                                                <?php $stars = $product->getAverageRating(); ?>
                                                <div class="rating">
                                                    <input type="hidden" class="rating" readonly data-fractions="2"
                                                           value={{ $stars }}/>
                                                            <span class="text text-info">
                                                                ({{ $reviewCount }}) reviews
                                                            </span>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </h4>
                                <ul class="list-unstyled">{!! $product->description_short !!}</ul>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">
                        @if(!$product->hasDiscount())
                            <span class="bold">
                                <span class="curr-sym">Ksh</span>
                                {{ $product->price }}
                                </span>
                        @else
                            <br/>
                            <p class="bold">
                                <span class="discounted-product-old-price">
                                    <span class="curr-sym">Ksh</span>
                                    {{ $product->price }}
                                </span>
                                <br/>
                                <span class="curr-sym">Ksh</span>
                                {{ $product->calculateDiscount(true)}}
                            </p>

                            <div class="discount-savings">
                                You save: {{ $product->discount }} &percnt;
                            </div>
                        @endif

                    </td>
                    <td data-th="Quantity">
                        <form method="POST" action="{{ route('cart.update', ['id' => $product->id]) }}"
                              class="form-horizontal" role="form">
                            <input type="hidden" name="_method" value="PATCH">
                            {!! generateCSRF() !!}
                            <input name="quantity" type="number" value="{{ $cart->getSingleProductQuantity($product) }}"
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
                    <td data-th="Subtotal" class="text-center"><span class="curr-sym">Ksh</span>&nbsp;{{ $cart->getProductPrice($product) }}</td>
                    <td class="actions" data-th="">
                        <form method="POST" action="{{ route('cart.update.remove', ['id' => $product->id]) }}"
                              class="form-horizontal">
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
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center">TOTALS: <strong><span
                                class="curr-sym">Ksh</span>&nbsp;{{ $cart->getSubTotal() }}</strong></td>
            </tr>
            <tr>
                <td><a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue
                        Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center">TOTAL: <br/><span class="curr-sym">Ksh</span>&nbsp;<p
                            class="bold">{{ $cart->getSubTotal() }}</p></td>
                <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
            </tfoot>
        </table>
        @endforeach
    </div>
@stop