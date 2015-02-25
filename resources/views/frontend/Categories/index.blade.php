@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Product name</title>
@stop

@section('breadcrumb')
    <div class="breadc">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#">Phones</a></li>
        </ol>
    </div>

@stop

@section('sidebar')

    @parent

@stop

@section('slider')
    <div id="grid-page-banner" class="col-sm-9 col-xs-12 col-md-9">
        <a href="#">
            {{ HTML::image('assets/images/banners/banner-gamer.jpg') }}
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <!-- ========================================= PRODUCT FILTER ========================================= -->
            <div class="widget">
                <h1>Product Filters</h1>

                <div class="body bordered">

                    <div class="category-filter">
                        <h2>Brands</h2>
                        <hr>
                        <ul>
                            <li><input checked="checked" class="le-checkbox" type="checkbox"><i class="fake-box"></i>
                                <label>Samsung</label> <span class="pull-right">(2)</span></li>
                            <li><input class="le-checkbox" type="checkbox"><i class="fake-box"></i> <label>Dell</label>
                                <span class="pull-right">(8)</span></li>
                            <li><input class="le-checkbox" type="checkbox"><i class="fake-box"></i>
                                <label>Toshiba</label> <span class="pull-right">(1)</span></li>
                            <li><input class="le-checkbox" type="checkbox"><i class="fake-box"></i> <label>Apple</label>
                                <span class="pull-right">(5)</span></li>
                        </ul>
                    </div>
                    <!-- /.category-filter -->

                    <div class="price-filter">
                        <h2>Price</h2>
                        <hr>
                        <div class="price-range-holder">

                            <div class="slider slider-horizontal" style="width: 182px;">
                                <div class="slider-track">
                                    <div class="slider-selection" style="left: 0%; width: 50%;">

                                    </div>
                                    <div class="slider-handle" style="left: 0%;">

                                    </div>
                                    <div class="slider-handle" style="left: 50%;">

                                    </div>
                                </div>
                                <div class="tooltip bottom top" style="top: -30px; left: 22.75px;">
                                    <div class="tooltip-arrow">

                                    </div>
                                    <div class="tooltip-inner">
                                        100 : 400
                                    </div>
                                </div>
                                <input type="text" class="price-slider" value="">
                            </div>

                <span class="min-max">
                    Price: $89 - $2899
                </span>
                <span class="filter-button">
                    <a href="#">Filter</a>
                </span>
                        </div>
                    </div>
                    <!-- /.price-filter -->

                </div>
                <!-- /.body -->
            </div>
            <!-- /.widget -->
            <!-- ========================================= PRODUCT FILTER : END ========================================= -->
            <!-- ========================================= LINKS ========================================= -->
            <div class="widget">
                <h1 class="border">information</h1>

                <div class="body">
                    <ul class="le-links">
                        <li><a href="#">delivery</a></li>
                        <li><a href="#">secure payment</a></li>
                        <li><a href="#">our stores</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                    <!-- /.le-links -->
                </div>
                <!-- /.body -->
            </div>
            <!-- /.widget -->
            <!-- ========================================= LINKS : END ========================================= -->
            <div class="widget">
                <div class="simple-banner">
                    <a href="#">
                        {{ HTML::image('assets/images/blank.gif', "", ['class' => 'img-responsive', 'data-echo' => URL::asset('assets/images/banners/banner-simple.jpg')]) }}
                    </a>
                </div>
            </div>
            <!-- ========================================= FEATURED PRODUCTS ========================================= -->
            <div class="widget">
                <h1 class="border">Featured Products</h1>
                <ul class="product-list">

                    <li class="sidebar-product-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="#" class="thumb-holder">
                                    {{ HTML::image('assets/images/blank.gif', "", ['class' => 'img-responsive', 'data-echo' => URL::asset('assets/images/products/product-small-01.jpg')]) }}

                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="#">Netbook Acer </a>

                                <div class="price">
                                    <div class="price-prev">$2000</div>
                                    <div class="price-current">$1873</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /.sidebar-product-list-item -->

                    <li class="sidebar-product-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="#" class="thumb-holder">
                                    {{ HTML::image('assets/images/blank.gif', "", ['class' => 'img-responsive', 'data-echo' => URL::asset('assets/images/products/product-small-02.jpg')]) }}
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="#">PowerShot Elph 115 16MP Digital Camera</a>

                                <div class="price">
                                    <div class="price-prev">$2000</div>
                                    <div class="price-current">$1873</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /.sidebar-product-list-item -->

                    <li class="sidebar-product-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="#" class="thumb-holder">
                                    {{ HTML::image('assets/images/blank.gif', "", ['class' => 'img-responsive', 'data-echo' => URL::asset('assets/images/products/product-small-03.jpg')]) }}
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="#">PowerShot Elph 115 16MP Digital Camera</a>

                                <div class="price">
                                    <div class="price-prev">$2000</div>
                                    <div class="price-current">$1873</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /.sidebar-product-list-item -->

                    <li class="sidebar-product-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="#" class="thumb-holder">
                                    {{ HTML::image('assets/images/blank.gif', "", ['class' => 'img-responsive', 'data-echo' => URL::asset('assets/images/products/product-small-01.jpg')]) }}
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="#">Netbook Acer </a>

                                <div class="price">
                                    <div class="price-prev">$2000</div>
                                    <div class="price-current">$1873</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /.sidebar-product-list-item -->

                </ul>
                <!-- /.product-list -->
            </div>
            <!-- /.widget -->
            <!-- ========================================= FEATURED PRODUCTS : END ========================================= -->
        </div>
        <div class="div.col-xs-12 col-sm-9 no-margin wide sidebar">
            <section id="gaming">
                <div class="grid-list-products">
                    <h2 class="section-title">Gaming</h2>

                    <div class="control-bar">
                        <div class="btn-group btn-input clearfix">
                            <button type="button" class="btn btn-default dropdown-toggle form-control"
                                    data-toggle="dropdown">
                                <span data-bind="label">sort by :</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Name</a></li>
                                <li><a href="#">Manufacturer</a></li>
                                <li><a href="#">Price</a></li>
                                <li><a href="#">Rating</a></li>
                            </ul>
                        </div>

                        <div class="btn-group btn-input clearfix">
                            <button type="button" class="btn btn-default dropdown-toggle form-control"
                                    data-toggle="dropdown">
                                <span data-bind="label">Results per page :</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">10</a></li>
                                <li><a href="#">20</a></li>
                                <li><a href="#">30</a></li>
                                <li><a href="#">40</a></li>
                                <li><a href="#">50+</a></li>
                            </ul>
                        </div>

                        <div class="grid-list-buttons">
                            <ul>
                                <li class="grid-list-button-item active"><a data-toggle="tab" href="#grid-view"><i
                                                class="fa fa-th-large"></i> Grid</a></li>
                                <li class="grid-list-button-item "><a data-toggle="tab" href="#list-view"><i
                                                class="fa fa-th-list"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.control-bar -->

                    <div class="tab-content">
                        <div id="grid-view" class="products-grid fade tab-pane in active">

                            <div class="product-grid-holder">
                                <div class="row no-margin">

                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">
                                            <div class="ribbon red"><span>sale</span></div>
                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">
                                                <div class="label-discount green">-50% sale</div>
                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="user-actions">
                                                <div class="add-cart-button pull-left">
                                                    <a href="#" class="le-button">add to cart</a>
                                                </div>
                                                <div class="wish-compare pull-right">
                                                    <a class="btn-add-to-wishlist" href="#"></a>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->


                                </div>
                                <div class="row no-margin">

                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                    <div class="col-xs-12 col-sm-4 col-md-3 no-margin product-item-holder">
                                        <div class="product-item">

                                            <div class="image">
                                                <img alt="" src="assets/images/products/product-01.jpg">
                                            </div>
                                            <div class="body">

                                                <div class="title">
                                                    <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                                </div>
                                                <div class="brand">sony</div>
                                                <div class="rating">product rating</div>
                                            </div>
                                            <div class="prices">

                                                <div class="price-current pull-left">$1199.00</div>
                                            </div>
                                            <div class="add-cart-button pull-left">
                                                <a href="#" class="le-button">add to cart</a>
                                            </div>
                                            <div class="wish-compare pull-right">
                                                <a class="btn-add-to-wishlist" href="#"></a>

                                            </div>
                                        </div>
                                        <!-- /.product-item -->
                                    </div>
                                    <!-- /.product-item-holder -->
                                </div>


                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.product-grid-holder -->

                        <div class="pagination-holder">
                            <div class="row">

                                <div class="col-xs-12 col-sm-6 text-left">
                                    <ul class="pagination ">
                                        <li class="current"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">next</a></li>
                                    </ul>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="result-counter">
                                        Showing <span>1-9</span> of <span>11</span> results
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.pagination-holder -->
                    </div>
                    <!-- /.products-grid #grid-view -->

                    <div id="list-view" class="products-grid fade tab-pane ">
                        <div class="products-list">

                            <div class="product-item product-item-holder">

                                <div class="ribbon blue"><span>new!</span></div>
                                <div class="row">
                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                        <div class="image">
                                            <img alt="" src="assets/images/products/product-01.jpg">
                                        </div>
                                    </div>
                                    <!-- /.image-holder -->
                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                        <div class="body">

                                            <div class="title">
                                                <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                            </div>
                                            <div class="rating">product rating</div>
                                            <div class="brand">sony</div>
                                            <div class="excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis
                                                    euismod erat sit amet porta. Etiam venenatis ac diam ac tristique.
                                                    Morbi accumsan consectetur odio ut tincidunt.</p>
                                            </div>
                                            <div class="addto-compare">
                                                <a class="btn-add-to-compare" href="#">add to compare list</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.body-holder -->
                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                        <div class="right-clmn">
                                            <div class="price-current">$1199.00</div>

                                            <div class="availability"><label>availability:</label><span
                                                        class="available">  in stock</span></div>
                                            <a class="le-button" href="#">add to cart</a>
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                        </div>
                                    </div>
                                    <!-- /.price-area -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product-item -->


                            <div class="product-item product-item-holder">
                                <div class="ribbon green"><span>bestseller</span></div>
                                <div class="row">
                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                        <div class="image">
                                            <img alt="" src="assets/images/products/product-02.jpg">
                                        </div>
                                    </div>
                                    <!-- /.image-holder -->
                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                        <div class="body">
                                            <div class="label-discount clear"></div>
                                            <div class="title">
                                                <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                            </div>
                                            <div class="brand">sony</div>
                                            <div class="excerpt">
                                                <div class="rating">product rating</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis
                                                    euismod erat sit amet porta. Etiam venenatis ac diam ac tristique.
                                                    Morbi accumsan consectetur odio ut tincidunt.</p>
                                            </div>
                                            <div class="addto-compare">
                                                <a class="btn-add-to-compare" href="#">add to compare list</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.body-holder -->
                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                        <div class="right-clmn">
                                            <div class="price-current">$1199.00</div>

                                            <div class="availability"><label>availability:</label><span
                                                        class="not-available">out of stock</span></div>
                                            <a class="le-button disabled" href="#">add to cart</a>
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                        </div>
                                    </div>
                                    <!-- /.price-area -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product-item -->


                            <div class="product-item product-item-holder">
                                <div class="ribbon red"><span>sell</span></div>
                                <div class="row">
                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                        <div class="image">
                                            <img alt="" src="assets/images/products/product-03.jpg">
                                        </div>
                                    </div>
                                    <!-- /.image-holder -->
                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                        <div class="body">
                                            <div class="label-discount clear"></div>
                                            <div class="title">
                                                <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                            </div>
                                            <div class="brand">sony</div>
                                            <div class="excerpt">
                                                <div class="rating">product rating</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis
                                                    euismod erat sit amet porta. Etiam venenatis ac diam ac tristique.
                                                    Morbi accumsan consectetur odio ut tincidunt. </p>
                                            </div>
                                            <div class="addto-compare">
                                                <a class="btn-add-to-compare" href="#">add to compare list</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.body-holder -->
                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                        <div class="right-clmn">
                                            <div class="price-current">$1199.00</div>

                                            <div class="availability"><label>availability:</label><span
                                                        class="available">in stock</span></div>
                                            <a class="le-button" href="#">add to cart</a>
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                        </div>
                                    </div>
                                    <!-- /.price-area -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product-item -->

                            <div class="product-item product-item-holder">
                                <div class="row">
                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                        <div class="image">
                                            <img alt="" src="assets/images/products/product-04.jpg">
                                        </div>
                                    </div>
                                    <!-- /.image-holder -->
                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                        <div class="body">

                                            <div class="title">
                                                <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                            </div>
                                            <div class="brand">sony</div>
                                            <div class="rating">product rating</div>
                                            <div class="excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis
                                                    euismod erat sit amet porta. Etiam venenatis ac diam ac tristique.
                                                    Morbi accumsan consectetur odio ut tincidunt. </p>
                                            </div>
                                            <div class="addto-compare">
                                                <a class="btn-add-to-compare" href="#">add to compare list</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.body-holder -->
                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                        <div class="right-clmn">
                                            <div class="price-current">$1199.00</div>

                                            <div class="availability"><label>availability:</label><span
                                                        class="available">  in stock</span></div>
                                            <a class="le-button" href="#">add to cart</a>
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                        </div>
                                    </div>
                                    <!-- /.price-area -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product-item -->

                            <div class="product-item product-item-holder">
                                <div class="ribbon green"><span>bestseller</span></div>
                                <div class="row">
                                    <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                        <div class="image">
                                            <img alt="" src="assets/images/products/product-05.jpg">
                                        </div>
                                    </div>
                                    <!-- /.image-holder -->
                                    <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                        <div class="body">
                                            <div class="label-discount clear"></div>
                                            <div class="title">
                                                <a href="#">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                            </div>
                                            <div class="brand">sony</div>
                                            <div class="excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis
                                                    euismod erat sit amet porta. Etiam venenatis ac diam ac tristique.
                                                    Morbi accumsan consectetur odio ut tincidunt.</p>
                                            </div>
                                            <div class="addto-compare">
                                                <a class="btn-add-to-compare" href="#">add to compare list</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.body-holder -->
                                    <div class="no-margin col-xs-12 col-sm-3 price-area">
                                        <div class="right-clmn">
                                            <div class="price-current">$1199.00</div>

                                            <div class="availability"><label>availability:</label><span
                                                        class="available">  in stock</span></div>
                                            <a class="le-button" href="#">add to cart</a>
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                        </div>
                                    </div>
                                    <!-- /.price-area -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product-item -->

                        </div>
                        <!-- /.products-list -->

                        <div class="pagination-holder">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 text-left">
                                    <ul class="pagination">
                                        <li class="current"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">next</a></li>
                                    </ul>
                                    <!-- /.pagination -->
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="result-counter">
                                        Showing <span>1-9</span> of <span>11</span> results
                                    </div>
                                    <!-- /.result-counter -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.pagination-holder -->

                    </div>
                    <!-- /.products-grid #list-view -->

                </div>
                <!-- /.tab-content -->
        </div>
        <!-- /.grid-list-products -->

        </section>
    </div>
    </div>


@stop