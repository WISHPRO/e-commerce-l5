@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container" style="margin-bottom: 84px">
        <section class="section wow fadeInUp animated">
            <h2 class="section-title">Featured Laptops</h2>
            @include('_partials.data.featured-products', ['data' => $featuredLaptops])
        </section>

        <br/>
        <section class="section wow fadeInUp animated m-t-30">
            <h2 class="section-title">Top Rated products</h2>
            @include('_partials.data.top-rated-products')
        </section>
        <!-- /.section -->
        <section class="section wow fadeInUp animated">
            <h2 class="section-title">New products</h2>
            @include('_partials.data.new-products')
        </section>
    </div>
@stop