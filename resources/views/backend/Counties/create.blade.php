@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Add County</title>
@stop

@section('content')

    <div class="row admin-form">
        <h2>Add counties that the products bought can be shipped to. This will also 'force' users to fill in location
            details as per this info</h2>
        <hr/>
        {!! Form::open(['url' => action('Backend\CountiesController@store')]) !!}
        <div class="col-md-6 category">

            @include('_partials.counties_form')
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-ok-sign"></span> Add County
                </button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop