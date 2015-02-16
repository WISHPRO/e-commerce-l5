@extends('layouts.frontend.master')

@section('head')
    @parent
    {!! HTML::style('assets/css/vendor/bootstrap/bootstrap-rating.css') !!}
    <title>{{ $product->name }}</title>
@show

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row single-product outer-bottom-sm ">
                <div class="col-md-3 sidebar">

                </div>
                <!-- /.sidebar -->
                <div class="col-md-9">
                        <div class="row  wow fadeInUp animated">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-lightbox="image-1" data-title="{{ $product->name . " images" }}"
                                               href="{{ ImageExists($product->image) ? asset($product->image) :  asset(env('IMG_ERROR'))  }}">
                                                <img class="img-responsive" src="{{ asset(env('IMG_AJAX')) }}"
                                                     data-echo="{{ ImageExists($product->image) ? asset($product->image) : asset(env('IMG_ERROR')) }} " id="zoom_img" data-zoom-image="{{ asset($product->image_large) }}"/>
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
                                    <h1 class="name">{{ beautify($product->name) }}</h1>

                                    <div class="rating-reviews m-t-20">
                                        <?php $reviewCount = getReviewCount($product); ?>
                                        @if(is_null($reviewCount))
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="rating rateit-small rateit">
                                                        <span class="text text-muted">Rating: </span>
                                                        <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                                        <span class="text text-info">(Not rated Yet)</span>
                                                    </div>
                                                </div>
                                            </div><!-- /.row -->
                                        @else
                                            <div class="row">
                                                <div class="col-sm-12">
                                                        <?php $stars = getAverageRating($product); ?>
                                                        <div class="rating">
                                                            <input type="hidden" class="rating" readonly data-fractions="2" value={{ $stars }} />
                                                            <span class="text text-info">
                                                                ({{ round($stars, 1) }}) out of
                                                                <a href="#review" class="lnk">({{ $reviewCount }}) reviews</a>
                                                            </span>
                                                        </div>
                                                </div>
                                            </div>

                                        @endif
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.rating-reviews -->
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    @if(hasRanOutOfStock($product))
                                                        <span class="value">Out of stock</span>
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
                                        <span class="text">SKU: </span> <b>{{ $product->sku }}</b>
                                    </div>
                                    @endif
                                    <div class="description-container m-t-20">
                                        <p>
                                            {{ str_limit($product->description) }}
                                            @if(exceedsLimit($product->description))
                                                <a href="{{ route('product.view', ['id' => $product->id ]) . "#description" }}">
                                                    <span class="read-more-bottom">(view more &rightarrow;)</span>
                                                </a>
                                            @endif
                                        </p>

                                    </div>
                                    <!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="price-box">
                                                    @if(!hasDiscount($product))
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
                                                            {{ calculateDiscount($product, true)}}
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
                                                       href="{{ route('mywishlist.add', ['id' => $product->id]) }}"
                                                       data-original-title="Add to Wishlist">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip"
                                                       data-placement="top" title="" href="#"
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
                                            @if(!hasRanOutOfStock($product))
                                            <div class="col-sm-3">
                                                <span class="label">Quantity :</span>
                                            </div>
                                            {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                            <div class="col-sm-3">
                                                @if($product->quantity <= 20)
                                                    {!! Form::selectRange('quantity', 1, $product->quantity, 1, ['class' => 'form-control']) !!}
                                                @else
                                                    <input name="quantity" type="number" min="1" max="{{ $product->quantity }}" class="form-control" required>
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="pull-right">

                                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                    <button type="submit" class="btn btn-primary" >
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
                        </div><!-- /.row -->

                        <div class="product-tabs inner-bottom-xs  wow fadeInUp animated">
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
                                                @if(filterCategories($product) >= 1)
                                                <ul>
                                                    <li>
                                                        <b>Processor:</b> {{ !is_null($product->processor) ? $product->processor : "N/A" }}
                                                    </li>
                                                    <li>
                                                        <b>Total
                                                            RAM:</b> {{ !is_null($product->memory) ? $product->memory : "N/A" }}
                                                    </li>
                                                    <li>
                                                        <b>Storage
                                                            capacity:</b> {{ !is_null($product->storage) ? $product->storage : "N/A" }}
                                                    </li>
                                                    <li>
                                                        <b>Video
                                                            memory:</b> {{ !is_null($product->video_memory) ? $product->video_memory : "N/A" }}
                                                    </li>
                                                    <li>
                                                        <b>Operating
                                                            system:</b> {{ !is_null($product->operating_system) ? $product->operating_system : "N/A" }}
                                                    </li>
                                                    <li>
                                                        <b>Warranty:</b> {{ !is_null($product->warranty_period) ? $product->warranty_period . " months" : "N/A" }}
                                                    </li>
                                                </ul>
                                                @else

                                                    <p>{{ $product->description }}</p>

                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->

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
                                                            @foreach($product->reviews as $review)
                                                                <div class="row">
                                                                    <div class="pull-left col-md-2">
                                                                        <img class="media-object img-circle" src="{{ asset(env('IMG_AVATAR'))}}">
                                                                    </div>
                                                                    <div class="pull-right col-md-10">
                                                                        <h4>
                                                                            {{ beautify($review->user->first_name) }}
                                                                        </h4>
                                                                        <div class="rating">
                                                                            <input type="hidden" class="rating" readonly="readonly" data-fractions="2" value={{ $review->stars }} />
                                                                        </div>
                                                                        On <b>{{ $review->created_at }}</b> said
                                                                        <br/>
                                                                        <p class="media-comment">
                                                                            {{ $review->comment }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                            @endforeach
                                                            @else
                                                                <div class="row alert alert-warning">
                                                                    <p>This product hasn't been reviewed yet. You are welcome to add your review, by clicking the "add-review" tab above</p>
                                                                </div>

                                                            @endif

                                                        </div>
                                                        <div class="tab-pane" id="add-comment">
                                                            {!! Form::open(['route' => ['reviews.post', $product->id], 'class' => 'form-horizontal', 'id' => 'commentForm']) !!}
                                                                <div class="form-group">
                                                                    {!! Form::label('stars', 'Your Rating: ', []) !!}
                                                                    {!! Form::input('hidden', 'stars', null, ['class' => 'rating form-control', 'data-fractions' => 2, 'data-stop' => 5, 'data-start' => 0.5]) !!}
                                                                </div>
                                                                <div class="form-group">
                                                                    {!! Form::label('comment', 'Comment about the product: ', []) !!}
                                                                    {!! Form::textarea('comment', null, ['id' => 'addComment', 'rows' => 5, 'class' => 'form-control']) !!}
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-10">
                                                                        <button class="btn btn-success btn-circle text-uppercase"
                                                                                type="submit" id="submitComment"><span
                                                                                    class="glyphicon glyphicon-send"></span>
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            {!! Form::close() !!}
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
                        </div><!-- /.product-tabs -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/vendor/elevate-zoom/jquery.elevatezoom.js') !!}
    @parent
    {!! HTML::script('assets/js/vendor/bootstrap/bootstrap-rating.min.js') !!}
@stop