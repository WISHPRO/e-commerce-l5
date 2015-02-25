@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Add Product</title>
@stop

@section('content')
    <h2>Add a new Product. You can skip most specification options</h2>
    <hr/>
    <div class="row">
        {!! Form::open(['url' => action('Backend\ProductsController@store'), 'files' => true]) !!}
        @include('_partials.products_form')

        <div class="col-md-4" style="width: 50%; margin: 0 auto;">
            <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
                <span class="glyphicon glyphicon-ok-sign"></span> Add this product
            </button>
        </div>
        {!! Form::close() !!}

    </div>
@stop
