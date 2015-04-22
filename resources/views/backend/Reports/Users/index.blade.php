@extends('layouts.backend.master')

@section('header')
    @parent
    <title>System statistics</title>
@stop

@section('content')

    <div class="row">

        <h2>User Reports&nbsp;&nbsp;<i class="glyphicon glyphicon-stats"></i></h2>
        <hr/>
        <br/>

        <div class="col-md-2 stats">
            <div class="text-center">
                <h4>Users by county</h4>
            <span class="center-block">

                <a href="{{ route('users.reports.byCounty') }}">
                    <i class="fa fa-users fa-4x"></i>
                </a>

            </span>
            </div>

        </div>
    </div>

@stop