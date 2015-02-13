@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Shopping Cart</title>
@stop

@section('sidebar')
    <div id="top-banner-and-menu">

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Authentication</li>
            </ol>

        </div>

    </div><!-- /#top-banner-and-menu -->
@stop


@section('content')

    <section id="cart-page">
        <div class="container">
            <!-- ========================================= CONTENT ========================================= -->
            <div class="col-xs-12 col-md-8 items-holder no-margin">

                <div class="row no-margin cart-item">
                    <div class="col-xs-12 col-sm-2 no-margin">
                        <a href="#" class="thumb-holder">
                            <img class="lazy" alt="" src="assets/images/products/product-small-01.jpg">
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-5 ">
                        <div class="title">
                            <a href="#">white lumia 9001</a>
                        </div>
                        <div class="brand">sony</div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <div class="quantity">
                            <div class="le-quantity">
                                <form>
                                    <a class="minus" href="#reduce"></a>
                                    <input name="quantity" readonly="readonly" type="text" value="1">
                                    <a class="plus" href="#add"></a>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-2 no-margin">
                        <div class="price">
                            $2000.00
                        </div>
                        <a class="close-btn" href="#"></a>
                    </div>
                </div>
                <!-- /.cart-item -->

                <div class="row no-margin cart-item">
                    <div class="col-xs-12 col-sm-2 no-margin">
                        <a href="#" class="thumb-holder">
                            <img class="lazy" alt="" src="assets/images/products/product-small-01.jpg">
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-5">
                        <div class="title">
                            <a href="#">white lumia 9001 </a>
                        </div>
                        <div class="brand">sony</div>
                    </div>

                    <div class="col-xs-12 col-sm-3 no-margin">
                        <div class="quantity">
                            <div class="le-quantity">
                                <form>
                                    <a class="minus" href="#reduce"></a>
                                    <input name="quantity" readonly="readonly" type="text" value="1">
                                    <a class="plus" href="#add"></a>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-2 no-margin">
                        <div class="price">
                            $2000.00
                        </div>
                        <a class="close-btn" href="#"></a>
                    </div>
                </div>
                <!-- /.cart-item -->

            </div>
            <!-- ========================================= CONTENT : END ========================================= -->

            <!-- ========================================= SIDEBAR ========================================= -->

            <div class="col-xs-12 col-md-4 no-margin sidebar ">
                <div class="widget cart-summary">
                    <h1 class="border">shopping cart</h1>

                    <div class="body">
                        <ul class="tabled-data no-border inverse-bold">
                            <li>
                                <label>cart subtotal</label>

                                <div class="value pull-right">$8434.00</div>
                            </li>
                            <li>
                                <label>shipping</label>

                                <div class="value pull-right">free shipping</div>
                            </li>
                        </ul>
                        <ul id="total-price" class="tabled-data inverse-bold no-border">
                            <li>
                                <label>order total</label>

                                <div class="value pull-right">$8434.00</div>
                            </li>
                        </ul>
                        <div class="buttons-holder">
                            <a class="le-button big" href="#">checkout</a>
                            <a class="simple-link block" href="#">continue shopping</a>
                        </div>
                    </div>
                </div>
                <!-- /.widget -->

            </div>
            <!-- /.sidebar -->

            <!-- ========================================= SIDEBAR : END ========================================= -->
        </div>
    </section>

@stop