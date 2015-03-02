@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container">

        <h3>Top rated products</h3>
        <br/>

        <div class="row products-homepage">
            @foreach($topProducts as $product)
                <div class="col-sm-3 col-lg-3 col-md-3 a">
                    <a href="{{ route('product.view', ['id' => $product->id]) }}">
                        <img class="img-responsive img-thumbnail" src={{ displayImage($product) }}>
                    </a>

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
                                <span class="text-muted">({{ $product->getSingleProductReviewCount() }} reviews)</span>
                            </p>
                        @else
                            <p>
                                <span class="text-muted">No reviews</span>
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
                                    data-placement="top" title="Tooltip on left">
                                <i class="fa fa-heart"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr/>
    </div>
@stop

@section('scripts')

    @parent
    {{--<script>--}}
    {{--jQuery( document ).ready( function( $ ) {--}}

    {{--$( "#addToCart" ).submit(function( event ) {--}}
    {{--event.preventDefault();--}}
    {{--var $form = $( this ),--}}
    {{--data = $form.serialize(),--}}
    {{--url = $form.attr( "action" );--}}

    {{--var posting = $.post( url, { formData: data } );--}}
    {{--console.log(posting);--}}
    {{--posting.done(function( data ) {--}}
    {{--if(data.fail) {--}}
    {{--alert();--}}
    {{--}--}}
    {{--if(data.success) {--}}

    {{--var successContent = "success";--}}
    {{--//$('#successMessage').html(successContent);--}}
    {{--Console.log(successContent);--}}
    {{--} //success--}}
    {{--}); //done--}}
    {{--});--}}

    {{--} );--}}
    {{--</script>--}}
@stop