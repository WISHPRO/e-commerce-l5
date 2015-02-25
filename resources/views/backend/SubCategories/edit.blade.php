@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Edit sub-category</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Modify a product sub-category</h2>
        <h6>Only the name field is required</h6>
        <hr/>
        {!! Form::model($subcategory,['url' => action('SubCategoriesController@update', ['id' => $subcategory->id]), 'method' => 'PATCH', 'files' => true]) !!}
        <div class="col-md-6">

            @include('_partials.categories_form')
            <div class="form-group">
                {!! Form::label('category_id', "Pick a category:", []) !!}
                {!! Form::select('category_id', App\Models\Category::lists('name', 'id'), null, [ 'class'=>'form-control']) !!}
                @if($errors->has('category_id'))
                    {{ $errors->first('category_id') }}
                @endif
            </div>
            <div class="row">
                <div class="pull-left">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok-sign"></span> Finish edit
                    </button>
                </div>
                <div class="pull-right">
                    <a href="#" data-toggle="modal" data-target="#delete">
                        <button class="btn btn-danger" data-title="Delete">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </a>
                </div>

            </div>
        </div>

        {!! Form::close() !!}

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title text-center">Delete prompt</h4>
                    </div>
                    {!! Form::open(['url' => action('Backend\SubcategoriesController@destroy', ['id' => $subcategory->id]), 'method' => 'DELETE']) !!}
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you
                            sure
                            you want to delete this sub-category?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left">
                            <a href="#">
                                <button class="btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-remove-sign"></span> Yes I do
                                </button>
                            </a>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> No, I don't
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@stop