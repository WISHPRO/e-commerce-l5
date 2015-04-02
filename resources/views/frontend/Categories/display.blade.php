@extends('layouts.frontend.master')

@foreach($data as $category)
@section('head')
    @parent
    <title>Viewing products in {{ $category->name }}</title>
@stop

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
                    @if($category->products->isEmpty())
                        <div class="row">
                            <div class="alert alert-info alert-dismissable" id="dismiss">
                                <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip"
                                        data-placement="top" title="dismiss message">&times;
                                </button>
                                <p class="text text-center">Ohh. <span class="fa fa-frown-o"></span>. we currently have
                                    no products belonging to '{{ beautify($category->name) }}'. We promise to restock as
                                    soon as possible</p>
                            </div>
                            <a href="{{ route('allproducts') }}">
                                <button class="btn btn-info center-block">
                                    Keep shopping
                                </button>
                            </a>

                        </div>
                    @else
                        <div class="clearfix filters-container m-t-10">
                            <div class="row">
                                <div class="col col-sm-6 col-md-2">
                                    <div class="filter-tabs">
                                        <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                            <li class="active">
                                                <a data-toggle="tab" href="#list-container">
                                                    <i class="icon fa fa-th-list"></i>List
                                                </a>
                                            </li>
                                            <li class="">
                                                <a data-toggle="tab" href="#grid-container"><i
                                                            class="icon fa fa-th"></i>Grid</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.filter-tabs -->
                                </div>
                                <div class="col col-sm-12 col-md-6">
                                    <div class="col col-sm-3 col-md-6 no-padding">
                                        <div class="lbl-cnt">
                                            <span class="lbl">Sort by</span>

                                            <div class="fld inline">
                                                <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                    <button data-toggle="dropdown" type="button"
                                                            class="btn dropdown-toggle">
                                                        Position <span class="caret"></span>
                                                    </button>

                                                    <ul role="menu" class="dropdown-menu">
                                                        <li role="presentation"><a href="#">Name (A-Z)</a></li>
                                                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                                        <li role="presentation"><a href="#">Rating</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /.fld -->
                                        </div>
                                        <!-- /.lbl-cnt -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col col-sm-3 col-md-6 no-padding">

                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-sm-6 col-md-4 text-right">
                                    {{ $data->render() }}
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="search-result-container">
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane" id="grid-container">
                                    <div class="category-product  inner-top-vs">
                                        <div class="row">

                                            @foreach($category->products as $product)
                                                <div class="col-sm-6 col-md-4 wow fadeInUp animated">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image m-b-20">
                                                                <div class="image">
                                                                    <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                                        <img src="{{ getAjaxImage() }}"
                                                                             class="img-responsive img-thumbnail"
                                                                             style="height: 240px; width: 290px"
                                                                             data-echo={{ displayImage($product) }}>
                                                                    </a>
                                                                </div>
                                                                <!-- /.image -->

                                                                @if($product->isNew())
                                                                    <div class="tag new">
                                                                        <span>new</span>
                                                                    </div>
                                                                @endif
                                                                @if($product->isHot())
                                                                    <div class="tag hot">
                                                                        <span>Hot</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-image -->
                                                            <div class="product-info text-left">
                                                                <h5>
                                                                    <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                                        {{ beautify($product->name) }}
                                                                    </a>
                                                                </h5>

                                                                <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                                                @if(!empty($reviewCount))
                                                                    <?php $stars = $product->getAverageRating(); ?>
                                                                    <div class="rating">
                                                                        <input type="hidden" class="rating" readonly
                                                                               data-fractions="2" value={{ $stars }}/>
                                                                            <span class="text text-info">
                                                                                ({{ $product->getSingleProductReviewCount() }} {{ $reviewCount > 1 ? str_plural('review') : str_singular('review') }}
                                                                                )
                                                                            </span>
                                                                    </div>
                                                                @else
                                                                    <div class="rating">
                                                                        <span class="text text-muted">Rating: </span>
                                                                        <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                                                        <span class="text text-info">(Not rated Yet)</span>
                                                                    </div>
                                                                @endif
                                                                <div class="product-price m-t-10 m-b-10">
                                                                    @if(!$product->hasDiscount())
                                                                        <span class="price">{{ $product->getPrice() }}</span>
                                                                    @else
                                                                        <span class="discounted-product-old-price">{{  $product->getPrice() }}</span>
                                                                        &nbsp;
                                                                        <span class="price">{{ $product->getPriceAfterDiscount() }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="description m-t-10 product-desc">
                                                                    {!! $product->description_short !!}

                                                                </div>
                                                            </div>
                                                            <!-- /.product-info -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action m-t-10">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                                                            {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                <i class="glyphicon glyphicon-shopping-cart inner-right-vs"></i>
                                                                                ADD TO CART
                                                                            </button>
                                                                            {!! Form::close() !!}

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
                                                <!-- /.item -->
                                            @endforeach
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.category-product -->

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane  active" id="list-container">
                                    <div class="category-product  inner-top-vs">
                                        @foreach($category->products as $product)
                                            <div class="category-product-inner wow fadeInUp animated">
                                                <div class="products">
                                                    <div class="product-list product">
                                                        <div class="row product-list-row">
                                                            <div class="col col-sm-4 col-lg-4">
                                                                <div class="product-image p-all-10">
                                                                    <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                                        <img src="{{ getAjaxImage() }}"
                                                                             class="img-responsive img-thumbnail"
                                                                             data-echo={{ displayImage($product) }}>
                                                                    </a>
                                                                </div>
                                                                <!-- /.product-image -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col col-sm-8 col-lg-8">
                                                                <div class="product-info">
                                                                    <h3 class="name">
                                                                        <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                                                            {{ beautify($product->name) }}
                                                                        </a>
                                                                    </h3>
                                                                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                                                    @if(!empty($reviewCount))
                                                                        <?php $stars = $product->getAverageRating(); ?>
                                                                        <div class="rating">
                                                                            <input type="hidden" class="rating" readonly
                                                                                   data-fractions="2"
                                                                                   value={{ $stars }}/>
                                                                            <span class="text text-info">
                                                                                ({{ $product->getSingleProductReviewCount() }} {{ $reviewCount > 1 ? str_plural('review') : str_singular('review') }}
                                                                                )
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="rating">
                                                                            <span class="text text-muted">Rating: </span>
                                                                            <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                                                            <span class="text text-info">(Not rated Yet)</span>
                                                                        </div>
                                                                    @endif
                                                                    <div class="product-price">
                                                                        @if(!$product->hasDiscount())
                                                                            <span class="price">{{ $product->getPrice() }}</span>
                                                                        @else
                                                                            <span class="discounted-product-old-price">{{  $product->getPrice() }}</span>
                                                                            &nbsp;
                                                                            <span class="price">{{ $product->getPriceAfterDiscount() }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="description m-t-10 product-desc">
                                                                        {!! $product->description_short !!}

                                                                    </div>
                                                                    <div class="cart clearfix animate-effect">
                                                                        <div class="action">
                                                                            <ul class="list-unstyled">
                                                                                <li class="add-cart-button btn-group">
                                                                                    {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                                                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                                                                    <button type="submit"
                                                                                            class="btn btn-primary">
                                                                                        <i class="glyphicon glyphicon-shopping-cart inner-right-vs"></i>
                                                                                        ADD TO CART
                                                                                    </button>
                                                                                    {!! Form::close() !!}

                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                        <!-- /.action -->
                                                                    </div>
                                                                    <!-- /.cart -->

                                                                </div>
                                                                <!-- /.product-info -->
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.product-list-row -->
                                                        @if($product->isNew())
                                                            <div class="tag new">
                                                                <span>new</span>
                                                            </div>
                                                        @endif
                                                        @if($product->isHot())
                                                            <div class="tag hot">
                                                                <span>Hot</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-list -->
                                                </div>
                                                <!-- /.products -->
                                            </div><!-- /.category-product-inner -->
                                        @endforeach
                                    </div>
                                    <!-- /.category-product -->
                                </div>
                                <!-- /.tab-pane #list-container -->
                            </div>
                            <!-- /.tab-content -->
                            <div class="clearfix filters-container">

                                <div class="text-right">
                                    {{ $data->render() }}
                                </div>
                                <!-- /.text-right -->

                            </div>
                            <!-- /.filters-container -->

                        </div>
                        <!-- /.search-result-container -->
                    @endif

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
@stop

@endforeach