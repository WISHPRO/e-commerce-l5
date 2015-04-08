@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Empty Shopping cart</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="empty-cart-message alert alert-info">
                    <h1>Your Shopping cart is Empty</h1>
                </div>
                <div class="row">
                    <p>Search for products, check out our top brands or just visit
                        the {!! link_to_route('home', 'homepage')!!} to get started
                    </p>

                    <p>You can also shop for products below, or</p>

                    <p>If you have an account, {!! link_to_route('login', 'Sign In') !!} to view your cart</p>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="section wow fadeInUp animated m-t-30 m-b-20">
                <h2 class="section-title">Top Rated products</h2>
                @include('_partials.data.home-page.top-rated-products')
            </section>
        </div>
    </div>
@stop