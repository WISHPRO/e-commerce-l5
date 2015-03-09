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
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row single-product outer-bottom-sm ">
                <div class="col-md-3 sidebar">

                </div>
                <!-- /.sidebar -->
                <div class="col-md-9">
                    <?php $stockUnavailable = $product->hasRanOutOfStock(); ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide1">
                                        <a data-lightbox="image-1" data-title="{{ $product->name . " images" }}"
                                           href="{{ displayImage($product)  }}">
                                            <img class="img-responsive" src="{{ displayImage($product) }} "
                                                 id="zoom_img" data-zoom-image="{{ asset($product->image_large) }}"/>
                                        </a>
                                    </div>
                                    <span class="text text-muted text-center"><i class="fa fa-search-plus"></i> Hover over image to zoom. You can also use your mouse wheel to zoom</span>
                                    <!-- /.single-product-gallery-item -->
                                </div>
                                <!-- /.single-product-slider -->

                            </div>
                            <!-- /.single-product-gallery -->
                        </div>
                        <div class="col-sm-6 col-md-7 product-info-block">
                            <div class="product-info">
                                <h1 class="name">{{ $product->name() }}</h1>

                                <div class="rating-reviews m-t-10">
                                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                    @if(empty($reviewCount))
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="rating rateit-small rateit">
                                                    <span class="text text-muted bold">Rating:&nbsp;</span>
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
                                                    <span class="text text-muted bold">Rating:&nbsp;</span>
                                                    <input type="hidden" class="rating" readonly data-fractions="2"
                                                           value={{ $stars }}/>
                                                            <span class="text text-info">
                                                                ({{ round($stars, 1) }}) out of
                                                                <a href="#review" class="lnk">({{ $reviewCount }})
                                                                    reviews</a>
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
                                                <span class="text text-muted bold">
                                                    Category: &nbsp;
                                                </span>
                                                <span class="text text-info">
                                                    <a href="{{ route('f.categories.view', ['id' => $product->categories->implode('id'), 'name' => $product->categories->implode('name')]) }}">
                                                        {{ beautify($product->categories->implode('name')) }}
                                                    </a>

                                                </span>
                                            <br/>
                                        </div>
                                        <div class="col-sm-12 m-t-5">
                                            <span class="text text-muted bold">
                                                    Manufacturer: &nbsp;
                                                </span>
                                                <span class="text text-info">
                                                    <a href="{{ route('brands.shop', ['id' => $product->brands->implode('id'), 'name' => $product->brands->implode('name')]) }}">
                                                        {{ beautify($product->brands->implode('name')) }}
                                                    </a>

                                                </span>
                                            <br/>
                                        </div>
                                    </div>
                                    <div class="row m-t-5">
                                        <div class="col-sm-6">
                                            <div class="stock-box">
                                                <span class="text text-muted bold">Availability: &nbsp;</span>
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
                                        <span class="text text-muted bold">SKU:&nbsp;</span> {{ $product->sku }}
                                    </div>
                                @endif
                                <div class="description-container m-t-20">
                                    <span class="text text-muted bold">Specifications :</span>

                                    <p>
                                        {!! $product->description_short !!}
                                    </p>

                                </div>
                                <!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="price-box">
                                                @if(!$product->hasDiscount())
                                                    <span class="price">
                                                         <span class="curr-sym">Ksh</span>
                                                        {{ $product->price }}
                                                        </span>
                                                @else
                                                    <span class="price-strike">
                                                            <span class="curr-sym">Ksh</span>
                                                        {{ $product->price }}
                                                        </span>
                                                    &nbsp;
                                                    <span class="price">
                                                         <span class="curr-sym">Ksh</span>
                                                        {{ $product->calculateDiscount(true)}}
                                                        </span>

                                                    <div class="savings">
                                                        You save: {{ $product->discount }} &percnt;
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="favorite-button m-t-10 pull-right">
                                                <a class="btn btn-primary" data-toggle="tooltip"
                                                   data-placement="top" title=""
                                                   href="#"
                                                   data-original-title="Add to Wishlist">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" title="email product" data-toggle="modal"
                                                   data-target="#emailProduct"
                                                   href="{{ route('products.email', ['id' => $product->id]) }}"
                                                   data-original-title="E-mail product">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.price-container -->
                                <div class="quantity-container info-container">
                                    <div class="row">
                                        @if(!$stockUnavailable)
                                            <div class="col-sm-3">
                                                <span class="label">Quantity :</span>
                                            </div>
                                            {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                            <div class="col-sm-3">
                                                @if($product->quantity <= config('site.quantity.max_selectable', 10))
                                                    {!! Form::selectRange('quantity', 1, $product->quantity, 1, ['class' => 'form-control']) !!}
                                                @else
                                                    <input name="quantity" type="number" min="1"
                                                           max="{{ $product->quantity }}" class="form-control">
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="pull-right">

                                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                    </button>

                                                </div>

                                            </div>
                                        @else
                                            <div class="col-sm-12 alert alert-warning">
                                                <p>This product is currently out of stock.</p>

                                                <p>We promise to restock as soon as possible</p>
                                            </div>
                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.quantity-container -->

                                <div class="product-social-link m-t-20 text-right">
                                    <span class="social-label">Share :</span>

                                    <div class="social-icons">
                                        <ul class="list-inline">
                                            <li><a class="fa fa-facebook" href="#"></a></li>
                                            <li><a class="fa fa-twitter" href="#"></a></li>
                                            <li><a class="fa fa-rss" href="#"></a></li>
                                            <li><a class="fa fa-pinterest" href="#"></a></li>
                                        </ul>
                                        <!-- /.social-icons -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.product-info -->
                        </div>
                        <!-- /.col-sm-7 -->
                    </div>
                    <!-- /.row -->

                    <div class="product-tabs inner-bottom-xs  ">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active">
                                        <a data-toggle="tab" href="#description">Product description</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#review">Product reviews</a>
                                    </li>
                                </ul>
                                <!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            {!! $product->description_long !!}
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <?php $reviewed = Auth::check() ? Auth::user()->hasMadeProductReview(
                                            $product->id
                                    ) : false ?>
                                    <div id="review" class="tab-pane">
                                        <div class="row">
                                            <h3 class="reviews">Product reviews</h3>

                                            <div class="comment-tabs">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="active">
                                                        <a href="#comments-tab" role="tab" data-toggle="tab">
                                                            <p class="reviews text-capitalize">All reviews
                                                            </p>
                                                        </a>
                                                    </li>
                                                    <li>

                                                        <a href="#add-comment" role="tab" data-toggle="tab">
                                                            <p class="reviews text-capitalize">Add your review</p>
                                                        </a>

                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="comments-tab">
                                                        @if(!($product->reviews->isEmpty()))

                                                            @if($product->reviews->count() >= 5)
                                                                <?php
                                                                $exceeded = true;
                                                                $data = $product->grabReviews();
                                                                ?>
                                                            @else
                                                                <?php $data = $product->grabReviews();
                                                                ?>
                                                            @endif

                                                            <div class="row rating-breakdown">
                                                                <div class="col-xs-12 col-md-12">
                                                                    <div class="well well-sm">
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-md-6 text-center">
                                                                                <h1 class="rating-num">
                                                                                    {{ round($stars, 1) }}
                                                                                </h1>

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
                                                                            <div class="col-xs-12 col-md-6">
                                                                                <div class="row rating-desc">
                                                                                    <div class="col-xs-3 col-md-3 text-right">
                                                                                        <span class="glyphicon glyphicon-star"></span>5
                                                                                    </div>
                                                                                    <div class="col-xs-8 col-md-9">
                                                                                        <div class="progress progress-striped">
                                                                                            <div class="progress-bar progress-bar-success"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="20"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: 80%">
                                                                                                <span class="sr-only">80%</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end 5 -->
                                                                                    <div class="col-xs-3 col-md-3 text-right">
                                                                                        <span class="glyphicon glyphicon-star"></span>4
                                                                                    </div>
                                                                                    <div class="col-xs-8 col-md-9">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-success"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="20"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: 60%">
                                                                                                <span class="sr-only">60%</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end 4 -->
                                                                                    <div class="col-xs-3 col-md-3 text-right">
                                                                                        <span class="glyphicon glyphicon-star"></span>3
                                                                                    </div>
                                                                                    <div class="col-xs-8 col-md-9">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-info"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="20"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: 40%">
                                                                                                <span class="sr-only">40%</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end 3 -->
                                                                                    <div class="col-xs-3 col-md-3 text-right">
                                                                                        <span class="glyphicon glyphicon-star"></span>2
                                                                                    </div>
                                                                                    <div class="col-xs-8 col-md-9">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-warning"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="20"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: 20%">
                                                                                                <span class="sr-only">20%</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end 2 -->
                                                                                    <div class="col-xs-3 col-md-3 text-right">
                                                                                        <span class="glyphicon glyphicon-star"></span>1
                                                                                    </div>
                                                                                    <div class="col-xs-8 col-md-9">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-danger"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="80"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: 15%">
                                                                                                <span class="sr-only">15%</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end 1 -->
                                                                                </div>
                                                                                <!-- end row -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(Auth::check() & $reviewed)
                                                                <?php $user_review = Auth::user()->retrieveUserReview(
                                                                        $product->id
                                                                )?>
                                                                <div class="row alert-warning current-user-review">
                                                                    <h3>Your review</h3>
                                                                    @foreach($user_review as $review)
                                                                        <div class="pull-left col-md-2">
                                                                            <img class="media-object img-circle"
                                                                                 src="{{ getDefaultUserAvatar() }}">
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
                                                                            <a href="#add-comment" data-toggle="modal"
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
                                                        @else
                                                            <div class="row alert alert-warning">
                                                                <p>This product hasn't been reviewed yet. You are
                                                                    welcome to add your review, by clicking the
                                                                    "add-review" tab above</p>
                                                            </div>

                                                        @endif
                                                        @if(isset($exceeded))
                                                            <button class="btn btn-primary center-block"><i
                                                                        class="fa fa-arrow-circle-o-right"></i>&nbsp;
                                                                view all reviews
                                                            </button>
                                                        @endif
                                                    </div>
                                                    @if(isset($user_review))
                                                        <div class="modal fade" id="editReview" tabindex="-1"
                                                             role="dialog"
                                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content p-all-10">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                            Edit your review
                                                                        </h4>

                                                                        <p>press esc or the x button to exit this
                                                                            prompt</p>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {!! Form::open(['route' => ['product.reviews.update', 'product' => $product->id, 'review' => $user_review->implode('id')], 'class' => 'form-horizontal', 'id' => 'reviewsForm', 'method' => 'PUT']) !!}
                                                                        <div class="form-group">
                                                                            <label for="stars">New Rating:</label>
                                                                            <input id="stars" name="stars" type="hidden"
                                                                                   class="rating form-control"
                                                                                   data-fractions="2"
                                                                                   data-stop="{{ getMaxStars() }}"
                                                                                   data-start="0.5"
                                                                                   value={{ $user_review->implode('stars') }}/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="comment">Modify comment:</label>
                                                                            <textarea id="comment" name="comment"
                                                                                      rows="5" class="form-control"
                                                                                      required>{{ $user_review->implode('comment') }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                <button class="btn btn-primary text-uppercase"
                                                                                        type="submit"
                                                                                        id="submitComment">
                                                                                    Save changes
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="tab-pane" id="add-comment">
                                                        @if(Auth::check() and $reviewed)
                                                            <div class="alert alert-info">
                                                                <p>You've already reviewed this product</p>
                                                            </div>
                                                        @else
                                                            {!! Form::open(['route' => ['product.reviews.store', $product->id], 'class' => 'form-horizontal', 'id' => 'reviewsForm']) !!}
                                                            <div class="form-group rating">
                                                                <label for="stars"
                                                                       class="text text-muted">Rating:</label>
                                                                <input id="stars" name="stars" type="hidden"
                                                                       class="rating form-control" data-fractions="2"
                                                                       data-stop="{{ getMaxStars() }}"
                                                                       data-start="0.5"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="comment">Comment:</label>
                                                                <textarea id="comment" name="comment" rows="5"
                                                                          class="form-control" required
                                                                          placeholder="specify the reasons for your rating"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-10">
                                                                    <button class="btn btn-primary text-uppercase"
                                                                            type="submit" id="submitComment">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.product-tabs -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
@stop