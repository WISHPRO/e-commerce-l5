@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Edit Product</title>
@stop

@section('content')

    <div class="row">
        <h4>Modify Product information</h4>
        <hr/>
        {!! Form::model($product, ['url' => action('Backend\ProductsController@update', ['id' => $product->id]), 'method' => 'PATCH', 'files' => true]) !!}
        @include('_partials.forms.products.products_edit_form')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="pull-left">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok-sign"></span> Finish edit
                    </button>
                </div>
                <div class="pull-right">
                    <a href="#" data-toggle="modal" data-target="#deleteProduct">
                        <button class="btn btn-danger" data-title="Delete">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteProduct', 'route' => route('backend.products.destroy', ['id' => $product->id])])
@stop
