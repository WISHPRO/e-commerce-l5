@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Create a new product Manufacturer/brand</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Add a new product brand</h2>
        <hr/>
        {!! Form::open(['url' => action('Backend\BrandsController@store'), 'files' => true]) !!}
        <div class="col-md-6 category">

            @include('_partials.forms.brands_form')
            <hr/>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok-sign"></span> Add the brand
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop