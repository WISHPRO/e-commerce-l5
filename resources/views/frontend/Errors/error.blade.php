@extends('layouts.frontend.error')


@section('head')
    @parent
    <title>{{ $code }}</title>
@stop

@section('slider')

@show

@section('promo')

@show

@section('content')
    <div class="container">
        <div class="col-md-8 center-block">
            <div class="info-404 text-center">
                <h2 class="primary-color inner-bottom-xs"><i class="fa fa-frown-o"></i></h2>

                @if($code !== '404' | $code !== '500')
                    <p>{{ $message }}</p>
                    <p class="lead">Sorry for the Inconvenience. </p>
                    <p>
                        Here are some
                        things to try, as we work on it
                    </p>
                    <!-- end error message -->
                    <div class="sub-form-row inner-top-xs inner-bottom-xs">
                        {{ Form::open(['url' => '/', 'method' => 'get']) }}

                        {{ Form::text('query', null, ['placeholder' => "find some products", 'autocomplete' => "off"]) }}

                        <a href="#" class="le-button">Go</a>
                        {{--{{ Form::submit('Go', ['class' => '']) }}--}}

                        {{ Form::close() }}
                        @else
                            <p>{{ $message }}</p>
                        @endif
                    </div>
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn-lg huge"><i class="fa fa-home"></i> Go to Home Page</a>
                        <i class="fa fa-phone"></i> Call support @ 020100200
                    </div>

            </div>
        </div>
    </div>

@stop
