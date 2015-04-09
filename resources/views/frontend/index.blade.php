@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container" style="margin-bottom: 84px">
        <section class="section wow fadeInUp animated m-b-20">
            <h2 class="section-title">Featured Laptops</h2>
            @include('_partials.data.home-page.featured-products', ['data' => $featuredLaptops])
        </section>

        <section class="section wow fadeInUp animated m-t-30 m-b-20">
            <h2 class="section-title">Top Rated products</h2>
            @include('_partials.data.home-page.top-rated-products')
        </section>
        <!-- /.section -->
        <section class="section wow fadeInUp animated m-t-30 m-b-20">
            <h2 class="section-title">New products</h2>
            @include('_partials.data.home-page.new-products')
        </section>
    </div>
@stop