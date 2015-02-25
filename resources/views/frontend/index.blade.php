@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container">
        <section class="section ">
            <h3 class="section-title">Top rated products</h3>
            <div class="">
                @foreach($topProducts as $product)
                    <div class="item item-carousel">
                        <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                                <img class="img-responsive" src={{ displayImage($product) }}>
                                            </a>
                                        </div>
                                        <!-- /.image -->
                                        <div class="tag hot">
                                            <span>hot</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->
                                    <div class="product-info text-left">
                                        <h3 class="name">
                                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <div class="rating">
                                            <input type="hidden" class="rating" readonly data-fractions="2" value={{ getAverageRating($product) }} />
                                            <span class="text text-info">
                                                ({{ getReviewCount($product) }}) Reviews
                                            </span>
                                        </div>

                                        <div class="product-price">
                                            @if(hasDiscount($product))
                                                <span class="price"><span class="curr-sym">Ksh</span>
                                                    {{ calculateDiscount($product, true) }}
                                                </span>
                                                <span class="price-before-discount">
                                                    <span class="curr-sym">Ksh</span>
                                                    {{ $product->price }}
                                                </span>
                                                @else
                                                <span class="price">
                                                    <span class="curr-sym">Ksh</span>
                                                    {{ $product->price }}
                                                </span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                    <button type="submit" class="btn btn-primary" >
                                                        <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                    </button>
                                                    {!! Form::close() !!}
                                                </li>
                                                <li class="lnk wishlist">
                                                    <a class="add-to-cart" href="{{ route('mywishlist.add', ['id' => $product->id ]) }}" data-toggle="tooltip"
                                                       data-placement="top" data-original-title="Add to wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                        <!-- /.product -->
                        </div>
                        <!-- /.products -->
                    </div>
                    @endforeach
                            <!-- /.item -->
            </div>
            <!-- /.home-owl-carousel -->

               </section>
        <!-- /.section -->
        <hr/>
        <section class="section ">
            <h3 class="section-title">New products</h3>
            <div class="">
                @foreach($newProducts as $product)
                    <div class="item item-carousel">
                        <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                                <img src={{ displayImage($product) }}>
                                            </a>
                                        </div>
                                        <!-- /.image -->

                                        <div class="tag new">
                                            <span>New</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->
                                    <div class="product-info text-left">
                                        <h3 class="name">
                                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>

                                        {{--<div class="rating">--}}
                                            {{--<input type="hidden" class="rating" readonly="readonly" value={{ $product->stars }} />--}}
                                        {{--</div>--}}

                                        <div class="product-price">
                                            @if(hasDiscount($product))
                                                <span class="price"><span class="curr-sym">Ksh</span>
                                                    {{ calculateDiscount($product, true) }}
                                                </span>
                                                <span class="price-before-discount">
                                                    <span class="curr-sym">Ksh</span>
                                                    {{ $product->price }}
                                                </span>
                                            @else
                                                <span class="price">
                                                    <span class="curr-sym">Ksh</span>
                                                    {{ $product->price }}
                                                </span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="add-cart-button btn-group">
                                                    {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                    <button type="submit" class="btn btn-primary" >
                                                        <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                    </button>
                                                    {!! Form::close() !!}
                                                </li>

                                                <li class="lnk wishlist pull-right">
                                                    <a class="add-to-cart" href="{{ route('mywishlist.add', ['id' => $product->id]) }}" data-toggle="tooltip"
                                                       data-placement="top" data-original-title="Add to wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                        <!-- /.product -->
                        </div>
                        <!-- /.products -->
                    </div>
                    @endforeach
                            <!-- /.item -->
            </div>
            <!-- /.home-owl-carousel -->

        </section>
    </div>
@stop

@section('scripts')

    @parent
    {{--<script>--}}
        {{--jQuery( document ).ready( function( $ ) {--}}

            {{--$( "#addToCart" ).submit(function( event ) {--}}
                {{--event.preventDefault();--}}
                {{--var $form = $( this ),--}}
                        {{--data = $form.serialize(),--}}
                        {{--url = $form.attr( "action" );--}}

                {{--var posting = $.post( url, { formData: data } );--}}
                {{--console.log(posting);--}}
                {{--posting.done(function( data ) {--}}
                    {{--if(data.fail) {--}}
                        {{--alert();--}}
                    {{--}--}}
                    {{--if(data.success) {--}}

                        {{--var successContent = "success";--}}
                        {{--//$('#successMessage').html(successContent);--}}
                        {{--Console.log(successContent);--}}
                    {{--} //success--}}
                {{--}); //done--}}
            {{--});--}}

        {{--} );--}}
    {{--</script>--}}
@stop