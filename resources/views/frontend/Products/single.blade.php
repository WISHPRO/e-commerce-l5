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
        @include('_partials.modals.reviews.review-product', ['elementID' => 'reviewProduct'])
        <div class="container">
            <div class="row single-product outer-bottom-sm ">
                <!-- /.sidebar -->
                <div class="col-md-9">
                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>

                    @include('_partials.data.products-single-page.product-details', ['reviewCount' => $reviewCount])
                    <hr/>

                    <?php $reviewed = Auth::check() ? Auth::user()->hasMadeProductReview($product->id) : false ?>
                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <h2>Product Information</h2>

                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="#specifications" class="bold-lg" data-toggle="tab">
                                                More Product details </a>
                                        </li>
                                        <li>
                                            <a href="#reviews" class="bold-lg" data-toggle="tab">
                                                Product Reviews </a>
                                        </li>
                                        <li>
                                            <a href="#cust_QA" class="bold-lg" data-toggle="tab">
                                                Customer QA </a>
                                        </li>
                                        <li>
                                            <a href="#whats_included" class="bold-lg" data-toggle="tab">
                                                Whats included </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active product-desc" id="specifications">
                                            {!! $product->description_long !!}
                                        </div>
                                        <?php $stars = $product->getAverageRating(); ?>
                                        <div class="tab-pane" id="reviews">
                                            @include('_partials.data.products-single-page.product-reviews', ['stars' => $stars])
                                        </div>
                                        <div class="tab-pane" id="cust_QA">
                                            <div class="alert alert-info">
                                                <p>Customer QA feature coming soon!</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="whats_included">
                                            <div class="alert alert-info">
                                                <p>product inclusions feature coming soon!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-3  single-page-sidebar">

                    @include('_partials.data.products-single-page.cart-section')
                    <hr/>

                    <div class="m-t-20">
                        <h4>View related products</h4>
                        @include('_partials.data.products-single-page.related-products')
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
@stop