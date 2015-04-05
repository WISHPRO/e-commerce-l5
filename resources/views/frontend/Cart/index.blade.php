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
        <div class="col-md-6">
            <div class="empty-cart-message alert alert-info">
                <h1>Your Shopping cart is Empty</h1>
            </div>
            <div class="row">
                <p>Search for products, check out our top brands or just visit
                    the {!! link_to_route('home', 'homepage')!!} to get started</p>
                <p>If you have an account, {!! link_to_route('login', 'Sign In') !!} to view your cart</p>
            </div>
        </div>

        <section class="section wow fadeInUp animated">
            <h2 class="section-title">Featured Laptops</h2>
            @include('_partials.data.featured-laptops')
        </section>
    </div>
@stop