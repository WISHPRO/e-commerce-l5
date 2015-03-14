@extends('layouts.backend.master')

@section('header')
    @parent
            <!-- include style scripts for charts -->
    {!! HTML::style('assets/css/vendor/charts/morris.css') !!}
    {{--{!! HTML::style('assets/css/vendor/font-awesome.min.css') !!}--}}
    <title>PC-World Admin - Welcome</title>
@stop

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard
            </h1>
            <hr/>
            <h4>
                Welcome {{ Auth::user()->getUserName() }}
            </h4>

            <p>From the backend, you can configure most aspects of the system. You can add products, users, categories,
                and much more</p>

            <p>System statistics are also available</p>

            <p>Use the navigation bar above <i class="fa fa-arrow-up"></i> , to navigate to various configuration
                options</p>
        </div>
    </div>
    <!-- /.row -->
    <br/>
    <hr/>
@stop

@section('scripts')
    @parent
@stop