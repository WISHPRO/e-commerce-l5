@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Create a new product Manufacturer/brand</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Add a new product brand</h2>
        <h6>Only the name field is required</h6>
        <hr/>
        {!! Form::open(['url' => action('Backend\BrandsController@create'), 'files' => true]) !!}
        <div class="col-md-6 category">

            @include('_partials.brands_form')

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-ok-sign"></span> Add the brand
                </button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
@stop