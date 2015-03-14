@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Add County</title>
@stop

@section('content')

    <div class="row admin-form">
        <p>Add counties that the products bought can be shipped to</p>
        <hr/>
        {!! Form::open(['url' => action('Backend\CountiesController@store')]) !!}
        <div class="col-md-6 category">

            @include('_partials.forms.counties_form')
            <hr/>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok-sign"></span> Add County
                </button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop