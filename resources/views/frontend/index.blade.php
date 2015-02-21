@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container">
        <section class="section wow fadeInUp">
            <h3 class="section-title">Top rated products</h3>
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach($top_rated = array_get($ads, 'top-rated') as $product)
                    <div class="item item-carousel">
                        <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                                <img src="{{ getAjaxImage() }}"
                                                     data-echo={{ displayImage($product) }}>
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
        <div class="wide-banners wow fadeInUp outer-bottom-vs animated">
            <div class="row">
                <div class="col-md-12">
                    <div class="wide-banner cnt-strip">
                        <div class="image">
                            <img src="{{ asset('assets/images/banners/home-page-advert.jpg') }}">
                        </div>
                        <div class="strip">
                            <div class="strip-inner text-right">
                                <h1>one stop place for</h1>
                                <p class="normal-shopping-needs">ALL YOUR SHOPPING NEEDS</p>
                            </div>
                        </div>
                        <div class="new-label">
                            <div class="text">NEW</div>
                        </div><!-- /.new-label -->
                    </div><!-- /.wide-banner -->
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div>
        <section class="section wow fadeInUp">
            <h3 class="section-title">New products</h3>
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach($products = array_get($ads, 'new-products') as $product)
                    <div class="item item-carousel">
                        <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                                <img src="{{ getAjaxImage() }}"
                                                     data-echo={{ fileIsAvailable($product->image) ? asset($product->image) : getErrorImage() }}>
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