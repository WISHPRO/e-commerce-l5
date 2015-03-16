@extends('layouts.backend.master')

@section('header')
    @parent
    <title>System statistics</title>
@stop

@section('content')

    <div class="row">

        <h2>System statistics &nbsp;&nbsp;<i class="glyphicon glyphicon-stats"></i></h2>

        <p>This is the statistics dashboard. To view statistical data related to various components, use the menu below</p>
        <p>You can also access individual component statistics from the menu above <i class="fa fa-arrow-up"></i> </p>

        <hr/>
        <br/>

        <div class="col-md-2 stats">
            <div class="text-center">
                <h4>Users</h4>
            <span class="center-block">

                <a href="{{ route('backend.statistics.users') }}">
                    <i class="fa fa-users fa-4x"></i>
                </a>

            </span>
            </div>

        </div>
        <div class="col-md-2 stats">
            <div class="text-center">
                <h4>Sales</h4>
            <span class="center-block">

                <a href="{{ route('backend.statistics.sales') }}">
                    <i class="fa fa-money fa-4x"></i>
                </a>

            </span>
            </div>
        </div>
        <div class="col-md-2 stats">
            <div class="text-center">
                <h4>Security</h4>
            <span class="center-block">

                <a href="{{ route('backend.statistics.security') }}">
                    <i class="fa fa-lock fa-4x"></i>
                </a>

            </span>
            </div>
        </div>
    </div>

@stop