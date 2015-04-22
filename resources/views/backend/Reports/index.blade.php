@extends('layouts.backend.master')

@section('header')
    @parent
    <title>System statistics</title>
@stop

@section('content')

    <div class="row">

        <h2>System Reports &nbsp;&nbsp;<i class="glyphicon glyphicon-stats"></i></h2>

        <p>This is the reports/statistics dashboard. To view statistical data related to various components, use the
            menu
            below</p>

        <p>You can also access individual component statistics from the menu above <i class="fa fa-arrow-up"></i></p>

        <hr/>
        <br/>

        <div class="col-md-2 stats">
            <div class="text-center">
                <h4>Users</h4>
            <span class="center-block">

                <a href="{{ route('users.reports') }}">
                    <i class="fa fa-users fa-4x"></i>
                </a>

            </span>
            </div>

        </div>

        <div class="col-md-2 stats">
            <div class="text-center">
                <h4>Inventory</h4>
            <span class="center-block">

                <a href="{{ route('inventory.reports') }}">
                    <i class="fa fa-laptop fa-4x"></i>
                </a>

            </span>
            </div>

        </div>
    </div>

@stop