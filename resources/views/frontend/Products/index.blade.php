@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>
        {{ Request::get('q') == null ? "View products" : "Search results for " . Request::get('q') }}
    </title>
@stop
@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container">
        <div class="row products-homepage">
            <div class="col-md-3">
                data filters
            </div>

            <div class="col-md-9">
                <h2>Search Results</h2>

                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip" data-placement="top"
                            title="dismiss message">&times;</button>
                    <p>You searched for '{{ Request::get('q') }}'. We found {{ $products->count()}} products</p>
                </div>
                <div class="row">
                    <div class="col-md-3 pull-right filter-tabs">
                        <ul class="list-inline">
                            <li class="active">
                                <a id="grid" href="#grid-container">
                                    <i class="icon fa fa-th-list"></i>&nbsp;Grid
                                </a>
                            </li>
                            <li class="">
                                <a id="list" href="#list-container">
                                    <i class="icon fa fa-th"></i>&nbsp;List
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.filter-tabs -->
                    <br/>
                </div>
                @foreach($products as $product)
                    <div class="col-md-4 col-sm-4 col-xs-12 a" id="list-container">
                        <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                            <img class="img-responsive img-thumbnail" src={{ displayImage($product) }}>
                        </a>

                        <div class="col-md-12 col-sm-12 col-xs-12 product-price">
                            <h4>
                                <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                    {{ $product->name }}
                                </a>
                            </h4>
                        </div>
                        <div class="ratings">
                            @if($product->hasReviews())
                                <p>
                                    <input type="hidden" class="rating" readonly data-fractions="2"
                                           value={{ $product->getAverageRating() }}/>
                                    <span class="text-muted">({{ $product->getSingleProductReviewCount() }}
                                        reviews)</span>
                                </p>
                            @else
                                <p>
                                    <span class="text-muted">No reviews yet</span>
                                </p>
                            @endif
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 product-price m-t-3">
                            <p>
                                <span class="bold">Type:</span>&nbsp;
                                <a href="{{ route('f.subcategories.view', ['id' => $product->subcategories->implode('id')]) }}">
                                    {{ beautify($product->subcategories->implode('name')) }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 product-price m-t-3">
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
                        <div class="col-md-12 col-sm-12 col-xs-12 desc m-t-3">
                            <p>
                                {!! $product->description_short !!}
                            </p>

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 desc">
                            <div class="pull-right">
                                {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                </button>
                                {!! Form::close() !!}
                            </div>
                            <div class="pull-left">
                                {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="Add to wishlist">
                                    <i class="fa fa-heart"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($products as $product)
                    <div class="col-md-12 col-xs-12" id="grid-container">
                        <div class="col-md-4">
                            <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                <img class="img-responsive img-thumbnail" src={{ displayImage($product) }}>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-12 col-sm-12 col-xs-12 product-price">
                                <h4>
                                    <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </h4>
                            </div>
                            <div class="ratings">
                                @if($product->hasReviews())
                                    <p>
                                        <input type="hidden" class="rating" readonly data-fractions="2"
                                               value={{ $product->getAverageRating() }}/>
                                        <span class="text-muted">({{ $product->getSingleProductReviewCount() }}
                                            reviews)</span>
                                    </p>
                                @else
                                    <p>
                                        <span class="text-muted">No reviews yet</span>
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 product-price m-t-3">
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
                            <div class="col-md-12 col-sm-12 col-xs-12 desc m-t-3">
                                <p>
                                    {!! $product->description_short !!}
                                </p>

                                <div class="pull-right">
                                    {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                                <div class="pull-left">
                                    {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="Add to wishlist">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop