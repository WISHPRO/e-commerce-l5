@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Modify category</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Editing category [ <b>{{ $category->name }}</b> ]</h2>

        <div class="col-md-12">
            <a href="{{ url(URL::previous()) }}">
                <button class="btn btn-default"><i class="fa fa-arrow-left"></i>&nbsp;Back</button>
            </a>
        </div>
        <br/>
        <hr/>
        {!! Form::model($category, ['url' => action('Backend\CategoriesController@update', ['id' => $category->id]) , 'method' => 'PATCH']) !!}
        <div class="col-md-6 category">

            @include('_partials.forms.categories_form', ['name' => 'Category'])

            <hr/>
            <div class="pull-left">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok-sign"></span> Finish Edit
                </button>
            </div>
            <div class="pull-right">
                <a href="#" data-toggle="modal" data-target="#deleteCategory">
                    <button class="btn btn-danger" data-title="Delete">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>
                </a>
            </div>
        </div>
        {!! Form::close() !!}

        @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteCategory', 'route' => route('backend.categories.destroy', ['id' => $category->id])])
    </div>
@stop