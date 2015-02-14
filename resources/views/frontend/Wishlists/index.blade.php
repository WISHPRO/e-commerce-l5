@extends('layouts.frontend.master')

@section('head')
    @parent
    {!! HTML::style('assets/css/vendor/bootstrap/bootstrap-rating.css') !!}
    <title>Wishlist</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="my-wishlist-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 my-wishlist">
                        <h1 class="text-center">WishList</h1>
                            <div class="col-md-6 alert alert-info center-block">
                                <p class="text text-center">
                                    Get started. Please create a wishlist, and during
                                    your shopping, look out for products you love, then add them to your wishlist
                                </p>
                            </div>

                                    <a href="{{ route('mywishlist.create') }}">
                                        <button class="btn btn-success btn-lg center-block">
                                            <i class="fa fa-plus"></i> Create Wishlist
                                        </button>
                                    </a>
                        <br/>
                                    <p class="text text-center">If you already have a wishlist, please <a href="{{ route('login') }}">sign in</a> to view It </p>
                        <hr/>

                            <div class="row">
                                <div class="col-md-4">
                                    <i class="fa fa-list fa-4x wsh">

                                    </i>
                                    <div>
                                        <p class="lead">
                                            Organize yourself
                                        </p>
                                        <p>
                                            Stay organized, by creating multiple wishlists for yourself
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <i class="fa fa-share fa-4x wsh">

                                    </i>
                                    <div>
                                        <p class="lead">
                                            Share your wishlists
                                        </p>
                                        <p>
                                            Let your friends know what you love most, using the many social platforms that you love
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <i class="fa fa-pencil fa-4x wsh center-block">

                                    </i>
                                    <div>
                                        <p class="lead">
                                            Save Ideas
                                        </p>
                                        <p>
                                            Add unlimited ideas and products
                                        </p>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div><!-- /.row -->
            </div>
        </div><!-- /.container -->
    </div>
@stop

@section('scripts')

    @parent
    {!! HTML::script('assets/js/vendor/bootstrap/bootstrap-rating.min.js') !!}
@stop