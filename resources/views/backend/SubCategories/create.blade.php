@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Create sub-category</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Create a product sub-category</h2>
        <h6>Only the name field is required</h6>
        <hr/>
        {!! Form::open(['url' => action('Backend\SubCategoriesController@create'), 'files'=> true]) !!}
        <div class="col-md-6 category">

            @include('_partials.categories_form')

        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('category_id', "Pick a category:", []) !!}
                {!! Form::select('category_id', App\Models\Category::lists('name', 'id'), null, [ 'class'=>'form-control']) !!}
                @if($errors->has('category_id'))
                    {{ $errors->first('category_id') }}
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-ok-sign"></span> Create sub-category
                </button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop