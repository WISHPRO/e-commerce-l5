@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container">
        <section class="section wow fadeInUp animated">
            <h3 class="section-title">New Arrivals</h3>
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                <div class="owl-wrapper-outer">
                    <div class="owl-wrapper">
                        @foreach($topProducts as $product)
                            <div class="owl-item">
                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">
                                        <div class="product-image">
                                            <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                <img class="img-responsive img-thumbnail" src={{ displayImage($product) }}>
                                            </a>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->


                                        <div class="product-info text-left">
                                            <h3>
                                                <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h3>

                                            <div class="ratings">
                                                @if($product->hasReviews())
                                                    <p>
                                                        <input type="hidden" class="rating" readonly data-fractions="2"
                                                               value={{ $product->getAverageRating() }}/>
                                                        <span class="text-muted">({{ $product->getSingleProductReviewCount() }} reviews)</span>
                                                    </p>
                                                @else
                                                    <p>
                                                        <span class="text-muted">No reviews</span>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="description"></div>

                                            <div class="product-price">
                                                @if($product->hasDiscount())
                                                    <div class="price pull-left"><span class="curr-sym">Ksh</span>
                                                        {{ $product->calculateDiscount(true) }}
                                                    </div>
                                                    <div class="price-before-discount pull-right">
                                                        <span class="curr-sym">Ksh</span>
                                                        {{ $product->price }}
                                                    </div>
                                                @else
                                                    <div class="price pull-left">
                                                        <span class="curr-sym">Ksh</span>
                                                        {{ $product->price }}
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary" type="button">Add to cart
                                                        </button>

                                                    </li>

                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="index.php?page=detail"
                                                           title="Wishlist">
                                                            <i class="icon fa fa-heart"></i>
                                                        </a>
                                                    </li>

                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="index.php?page=detail"
                                                           title="Compare">
                                                            <i class="fa fa-retweet"></i>
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
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="owl-controls clickable">
                <div class="owl-buttons">
                    <div class="owl-prev"></div>
                    <div class="owl-next"></div>
                </div>
            </div>
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