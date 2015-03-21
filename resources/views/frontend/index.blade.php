@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container" style="margin-bottom: 84px">
        <section class="section wow fadeInUp">
            <h3 class="section-title">Top Rated products</h3>

            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach($topProducts as $product)
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image p-all-10">
                                        <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                            <img src="{{ getAjaxImage() }}" class="img-thumbnail img-responsive"
                                                 style="width: 320px; height: 240px"
                                                 data-echo={{ displayImage($product) }}>
                                        </a>
                                    </div>
                                    <!-- /.image -->

                                    <div class="tag hot">
                                        <span>HOT</span>
                                    </div>
                                </div>
                                <!-- /.product-image -->
                                <div class="product-info text-left p-all-10">
                                    <h3 class="name">
                                        <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                    @if(empty($reviewCount))
                                        <div class="rating">
                                            <span class="text text-muted bold">Rating:&nbsp;None</span>
                                        </div>
                                    @else
                                        <div class="rating">
                                            <?php $stars = $product->getAverageRating(); ?>
                                            <div class="rating">
                                                <span class="text text-muted bold">Rating:&nbsp;</span>
                                                <input type="hidden" class="rating" readonly data-fractions="2"
                                                       value={{ $stars }}/>
                                                <span class="text text-info">({{ $reviewCount }} reviews)</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="product-price">
                                        @if($product->hasDiscount())
                                            <span class="price"><span class="curr-sym">Ksh</span>
                                                {{ $product->calculateDiscount(true) }}
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
                                <div class="cart clearfix animate-effect p-all-10">
                                    <div class="action">
                                        <ul class="list-unstyled">

                                            <li class="add-cart-button btn-group">
                                                {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                                {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                </button>
                                                {!! Form::close() !!}
                                            </li>

                                            <li class="lnk wishlist pull-right">
                                                <a class="add-to-cart" href="#" data-toggle="tooltip"
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
        <section class="section wow fadeInUp">
            <h3 class="section-title">New products</h3>

            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach($newProducts as $product)
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image p-all-10">
                                        <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                            <img src="{{ getAjaxImage() }}" class="img-thumbnail img-responsive"
                                                 style="width: 320px; height: 240px"
                                                 data-echo={{ displayImage($product) }}>
                                        </a>
                                    </div>
                                    <!-- /.image -->

                                    <div class="tag new">
                                        <span>New</span>
                                    </div>
                                </div>
                                <!-- /.product-image -->
                                <div class="product-info text-left p-all-10">
                                    <h3 class="name">
                                        <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                    @if(empty($reviewCount))
                                        <div class="rating">
                                            <span class="text text-muted bold">Rating:&nbsp;None</span>
                                        </div>
                                    @else
                                        <div class="rating">
                                            <?php $stars = $product->getAverageRating(); ?>
                                            <div class="rating">
                                                <span class="text text-muted bold">Rating:&nbsp;</span>
                                                <input type="hidden" class="rating" readonly data-fractions="2"
                                                       value={{ $stars }}/>
                                                <span class="text text-info">({{ $reviewCount > 1 ? $reviewCount . " ". str_plural('review') : $reviewCount . " " . 'review' }}
                                                    )</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="product-price">
                                        @if($product->hasDiscount())
                                            <span class="price"><span class="curr-sym">Ksh</span>
                                                {{ $product->calculateDiscount(true) }}
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
                                <div class="cart clearfix animate-effect p-all-10">
                                    <div class="action">
                                        <ul class="list-unstyled">

                                            <li class="add-cart-button btn-group">
                                                {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                                {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                </button>
                                                {!! Form::close() !!}
                                            </li>

                                            <li class="lnk wishlist pull-right">
                                                <a class="add-to-cart" href="#" data-toggle="tooltip"
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