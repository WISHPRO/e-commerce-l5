@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Add County</title>
@stop

@section('content')

    <div class="row admin-form">
        <p>Add counties that the products bought can be shipped to</p>
        <hr/>
        {!! Form::open(['url' => action('Backend\CountiesController@store'), 'id' => 'countiesAddForm']) !!}
        <div class="col-md-6 category">

            @include('_partials.forms.counties.counties_form')
            <hr/>
            <div class="form-group">

            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop