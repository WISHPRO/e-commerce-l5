@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Update User</title>
@stop

@section('content')
    <div class="row admin-form">
        <h4>Updating {{ beautify($user->getUserName()) }}</h4>

        <p>Note: If you need to change the password only, just enter the new one and submit. same applies for other
            attributes</p>
        {!! Form::model($user, ['url' => action('Backend\UsersController@update', [ 'id' => $user->id ]), 'method' => 'PATCH']) !!}
        <div class="row">
            <div class="col-xs-10">
                <p class="form-control-static"><b>Created on:</b> <span class="text-info">{{ $user->created_at }}</span>
                    <b>Last Updated on:</b> <span class="text-info">{{ $user->updated_at }}</span></p>
            </div>
        </div>
        <hr/>
        @include('_partials.users_form', ['submitButtonText' => 'Finish edit'])
        <div class="row">
            <div class="col-md-4 pull-right">
                <a href="#" data-toggle="modal" data-target="#delete">
                    <button class="btn btn-danger btn-lg" data-title="Delete">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>
                </a>

            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title text-center"><span class="glyphicon glyphicon-warning-sign"></span> Delete
                        prompt</h4>
                </div>
                {!! Form::open(['url' => action('Backend\UsersController@destroy', ['id' => $user->id]), 'method' => 'DELETE']) !!}
                <div class="modal-body">
                    <div class="alert alert-danger">

                    <p>Are you sure you want to delete this user?</p> <br/>

                        <p><b>All their data will be lost. This includes;</b></p>
                        <ol>
                            <li>
                                order information
                            </li>
                            <li>
                                credit card data
                            </li>
                            <li>
                                personalization data
                            </li>
                            <li>
                                Audit trail
                            </li>
                        </ol>
                        <p><b>Think about this one hard, and press one of the options below</b></p>

                        <p>This really sucks. just don't do it</p>

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
@stop
