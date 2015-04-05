@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>
        {{ $product->name }}
    </title>
@stop

@section('slider')

@stop

@section('content')
    <div class="outer-top-xs">
        <div class="container">
            <div class="row single-product outer-bottom-sm ">
                <!-- /.sidebar -->
                <div class="col-md-9">
                    <?php $stockUnavailable = $product->hasRanOutOfStock(); ?>
                    <div class="row wow fadeInUp animated m-b-20">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide1">
                                        <a data-lightbox="image-1" data-title="{{ $product->name . " images" }}"
                                           href="{{ displayImage($product)  }}">
                                            <img class="img-responsive product-detail-image"
                                                 src="{{ displayImage($product) }}"
                                                 id="zoom_img" data-zoom-image="{{ asset($product->image_large) }}"/>
                                        </a>
                                    </div>
                                    <span class="text text-center"><i class="fa fa-search-plus"></i> Hover over image to zoom. You can also use your mouse wheel to zoom</span>
                                    <!-- /.single-product-gallery-item -->
                                </div>
                                <!-- /.single-product-slider -->

                            </div>
                            <!-- /.single-product-gallery -->
                        </div>
                        <div class="col-sm-6 col-md-7 product-info-block">
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>

                                <div class="rating-reviews m-t-10">
                                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                    @if(empty($reviewCount))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="rating">
                                                    <span class="text text-primary bold">Rating:&nbsp;</span>
                                                    <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                                    <span class="text text-info">Not reviewed Yet</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    @else
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php $stars = $product->getAverageRating(); ?>
                                                <div class="rating">
                                                    <span class="text text-primary bold">Rating:&nbsp;</span>
                                                    <input type="hidden" class="rating" readonly data-fractions="2"
                                                           value={{ $stars }}/>
                                                            <span class="text text-info">
                                                                <a href="#reviews" class="lnk">
                                                                    ({{ $reviewCount }})
                                                                    {{ $reviewCount > 1 ? str_plural('review') : str_singular('review') }}</a>
                                                            </span>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                                <!-- /.row -->
                                </div>
                                <!-- /.rating-reviews -->
                                <div class="stock-container info-container m-t-5">
                                    <div class="row">
                                        <div class="col-sm-12">
                                                <span class="text text-primary bold">
                                                    Category: &nbsp;
                                                </span>
                                                <span class="text text-info">
                                                    <a href="{{ route('f.categories.view', ['id' => $product->categories->implode('id'), 'name' => preetify($product->categories->implode('name'))]) }}">
                                                        {{ beautify($product->categories->implode('name')) }}
                                                    </a>

                                                </span>
                                            <br/>
                                        </div>
                                        <div class="col-sm-12 m-t-5">
                                            <span class="text text-primary bold">
                                                    Manufacturer: &nbsp;
                                                </span>
                                                <span class="text text-info">
                                                    <a href="{{ route('brands.shop', ['id' => $product->brands->implode('id'), 'name' => preetify($product->brands->implode('name'))]) }}">
                                                        {{ beautify($product->brands->implode('name')) }}
                                                    </a>

                                                </span>
                                            <br/>
                                        </div>
                                    </div>
                                    <div class="row m-t-5">
                                        <div class="col-sm-6">
                                            <div class="stock-box">
                                                <span class="text text-primary bold">Availability: &nbsp;</span>
                                                @if($stockUnavailable)
                                                    <span class="text text-danger">Out of stock</span>
                                                @else
                                                    <span class="value">In Stock</span>
                                                    <span class="text text-success">
                                                        ({{ $product->quantity }}) items
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.stock-container -->
                                @if(!empty($product->sku))
                                    <div class="m-t-5">
                                        <span class="text text-primary bold">SKU:&nbsp;</span> {{ $product->sku }}
                                    </div>
                                @endif
                                <div class="description-container m-t-20 product-desc">
                                    <span class="text text-primary bold">Specifications :</span>
                                    {!! $product->description_short !!}
                                </div>
                                <!-- /.description-container -->
                                @if($stockUnavailable)
                                    <div class="col-sm-12 alert alert-warning">
                                        <p>This product is currently out of stock.</p>

                                        <p>We promise to restock as soon as possible</p>
                                    </div>
                                    @endif
                                            <!-- /.quantity-container -->
                            </div>
                            <!-- /.product-info -->
                        </div>
                        <!-- /.col-sm-7 -->
                    </div>
                    <!-- /.row -->

                    <hr/>
                    <?php $reviewed = Auth::check() ? Auth::user()->hasMadeProductReview($product->id) : false ?>

                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <h2>Product Information</h2>

                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="#specifications" class="bold" data-toggle="tab">
                                                Product specifications </a>
                                        </li>
                                        <li>
                                            <a href="#reviews" class="bold" data-toggle="tab">
                                                Reviews </a>
                                        </li>
                                        <li>
                                            <a href="#cust_QA" class="bold" data-toggle="tab">
                                                Customer QA </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_4" class="bold" data-toggle="tab">
                                                Whats in the box </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active product-desc" id="specifications">
                                            {!! $product->description_long !!}
                                        </div>
                                        <div class="tab-pane" id="reviews">
                                            @if(($product->reviews->isEmpty()))
                                                <div class="alert alert-warning">
                                                    <p>This product hasn't been reviewed yet. You are welcome to add
                                                        your review</p>
                                                </div>

                                                @if(Auth::check() & !$reviewed)
                                                    <a href="#" data-toggle="modal" data-target="#reviewProduct">
                                                        <button class="btn btn-primary">
                                                            <i class="fa fa-plus"></i>&nbsp;Add my review
                                                        </button>
                                                    </a>
                                                @else
                                                    <div class="p-all-10" style="border: 1px solid #E3E3E3">
                                                        <p>{!! link_to_route('login', 'Login') !!}
                                                            or {!! link_to_route('register', 'Register') !!} today, to
                                                            be able to add your reviews about a product</p>
                                                    </div>

                                                @endif
                                            @else

                                                @if(Auth::check())
                                                    @if($product->reviews->count() >= config('site.products.reviews.display', 5))
                                                        <?php
                                                        $exceeded = true;
                                                        $data = $product->grabReviews(Auth::user(), config('site.products.reviews.display', 5));
                                                        ?>
                                                    @else
                                                        <?php $data = $product->grabReviews(Auth::user(), config('site.products.reviews.display', 5));
                                                        ?>
                                                    @endif

                                                @else
                                                    @if($product->reviews->count() >= config('site.products.reviews.display', 5))
                                                        <?php
                                                        $exceeded = true;
                                                        $data = $product->grabReviews(null, config('site.products.reviews.display', 5));
                                                        ?>
                                                    @else
                                                        <?php $data = $product->grabReviews(null, config('site.products.reviews.display', 5));
                                                        ?>
                                                    @endif
                                                    <div class="p-all-10" style="border: 1px solid #E3E3E3">
                                                        <p>{!! link_to_route('login', 'Login') !!}
                                                            or {!! link_to_route('register', 'Register') !!} today, to
                                                            be able to add your reviews about a product</p>
                                                    </div>
                                                @endif
                                                <div class="row rating-breakdown">
                                                    <div class="col-xs-12 col-md-12">
                                                        <div class="well well-sm">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-md-6 text-center">
                                                                    <h4 class="rating-num">
                                                                        {{ round($stars, 1) }}
                                                                    </h4>

                                                                    <div class="rating">
                                                                        <input type="hidden" class="rating"
                                                                               readonly data-fractions="2"
                                                                               value={{ $stars }}/>
                                                                    </div>
                                                                    <div>
                                                                        <span class="glyphicon glyphicon-user"></span>{{ $reviewCount }}
                                                                        total
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($reviewed)
                                                    <?php $user_review = Auth::user()->retrieveUserReview($product->id) ?>
                                                    <div class="row current-user-review">
                                                        <h3>Your review</h3>
                                                        @foreach($user_review as $review)
                                                            <div class="pull-left col-md-2">
                                                                <img class="media-object img-circle"
                                                                     src="{{ empty($review->user->avatar) ? getDefaultUserAvatar() : $review->user->avatar }}">
                                                            </div>
                                                            <div class="pull-right col-md-10">
                                                                <h4>
                                                                    {{ Auth::user()->getUserName() }}
                                                                </h4>
                                                                On <span
                                                                        class="bold">{{ $review->created_at }}</span>
                                                                <br/>

                                                                <div class="rating">
                                                                    <input type="hidden" class="rating"
                                                                           readonly
                                                                           data-fractions="2"
                                                                           value={{ $review->stars }}/>
                                                                </div>
                                                                <p class="media-comment">
                                                                    {{ $review->comment }}
                                                                </p>
                                                                <a href="#" data-toggle="modal"
                                                                   data-target="#editReview">
                                                                    <button class="btn btn-primary"><i
                                                                                class="fa fa-edit"></i>&nbsp;
                                                                        Edit review
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @endif
                                                <hr/>
                                                @foreach($data as $review)
                                                    <div class="row">
                                                        <div class="pull-left col-md-2">
                                                            <img class="media-object img-circle"
                                                                 src="{{ getDefaultUserAvatar() }}">
                                                        </div>
                                                        <div class="pull-right col-md-10">
                                                            <h4>
                                                                {{ beautify($review->user->first_name) }}
                                                            </h4>
                                                            On <span
                                                                    class="bold">{{ $review->created_at }}</span>
                                                            <br/>

                                                            <div class="rating">
                                                                <input type="hidden" class="rating" readonly
                                                                       data-fractions="2"
                                                                       value={{ $review->stars }}/>
                                                            </div>
                                                            <p class="media-comment">
                                                                {{ $review->comment }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                @endforeach
                                            @endif
                                            @if(isset($exceeded))
                                                <button class="btn btn-primary center-block"><i
                                                            class="fa fa-arrow-circle-o-right"></i>&nbsp;
                                                    view all reviews
                                                </button>
                                            @endif
                                        </div>
                                        <div class="tab-pane" id="cust_QA">
                                            <div class="alert alert-info">
                                                <p>Customer QA feature coming soon!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3  single-page-sidebar">
                    <div class="product-social-link text-right">
                        <div class="social-icons">
                            <ul class="list-inline">
                                <li>
                                    <span class="social-label">Share :</span>
                                </li>

                                <li><a class="fa fa-facebook" href="#"></a></li>
                                <li><a class="fa fa-twitter" href="#"></a></li>
                                <li><a class="glyphicon glyphicon-envelope" href="#"></a></li>
                                <li><a class="fa fa-pinterest" href="#"></a></li>
                            </ul>
                            <!-- /.social-icons -->
                        </div>
                        <hr/>

                        <table class="table table-responsive">
                            {!! Form::open(['route' => ['cart.add', $product->id], 'class' => 'addToCart']) !!}
                            <tr>
                                <th>
                                    Qty:
                                </th>
                                <td>

                                    @if($product->quantity <= config('site.products.quantity.max_selectable', 10))
                                        {!! Form::selectRange('quantity', 1, $product->quantity, 1, ['class' => 'form-control pull-left', 'style' => 'width:80px']) !!}
                                    @else
                                        <input name="quantity" type="number" min="1"
                                               max="{{ $product->quantity }}" class="form-control pull-left"
                                               style="width: 80px">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    @if(!$product->hasDiscount())
                                        <span class="price">{{ $product->getPrice() }}</span>
                                    @else
                                        <span class="discounted-product-old-price">{{  $product->getPrice() }}</span>
                                        &nbsp;
                                        <span class="price">{{ $product->getPriceAfterDiscount() }}</span>

                                        <div class="savings">
                                            You save: {{ $product->getDiscountRate() }} &percnt;
                                            ({{ $product->getDiscountAmount() }})
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr class="m-t-40">
                                <th></th>
                                <td>
                                    @if($product->quantity <= 2)
                                        <div class="alert alert-warning">
                                            <p class="text text-justify"><i class="fa fa-warning"></i>&nbsp;This product
                                                is almost running out of stock.</p>
                                        </div>
                                    @endif
                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="glyphicon glyphicon-shopping-cart inner-right-vs"></i> ADD TO CART
                                    </button>
                                </td>
                            </tr>
                            {!! Form::close() !!}
                        </table>
                    </div>

                    <hr/>

                    <div class="m-t-20">
                        <h4>View related products</h4>
                        <?php $related = $product->getRelated()?>
                        @if($related->isEmpty())
                            <div class="p-all-10 alert alert-info">
                                <p>There are no related products</p>
                            </div>
                        @else
                            <div class="p-all-10">
                                @foreach($related as $product)
                                    <div class="row">
                                        <div class="pull-left" style="padding-bottom: 10px">
                                            <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                <img src="{{ displayImage($product) }}"
                                                     class="img-responsive img-thumbnail"
                                                     style="height: 80px; width: 80px">
                                            </a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                            <span class="text-right">
                                                {{ beautify($product->name) }}
                                            </span>
                                            </a>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        @endif

                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        @if(isset($user_review))
            @include('_partials.modals.reviews.editReview', ['elementID' => 'editReview'])
        @endif
        @include('_partials.modals.reviews.review-product', ['elementID' => 'reviewProduct'])
    </div>
@stop