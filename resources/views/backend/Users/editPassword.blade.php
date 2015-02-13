@extends('layouts.admin.master')

@section('header')
    @parent
    <title>Admin - Update User password</title>
@stop

@section('content')
    <div class="row admin-form">
        <h4>Updating {{ $user->user_name }}'s password</h4>
        <hr/>
        {{ Form::model($user, ['route' => ['adminusers.updatepassword', $user->id] , 'method' => 'put']) }}

        @include('_partials.edit_password')
        <div class="row">
            <div class="pull-left">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok-sign"></span> save password
                </button>
            </div>
            <div class="pull-right">
                <a href="#" data-toggle="modal" data-target="#delete">
                    <button class="btn btn-danger" data-title="Delete">
                        <span class="glyphicon glyphicon-trash"></span> Delete user
                    </button>
                </a>
            </div>

        </div>


        {{ Form::close() }}
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
                {{ Form::open(['route' => ['users.delete', 'id' => $user->id], 'method' => 'delete']) }}
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
                                <span class="glyphicon glyphicon-remove-sign"></span> Yes I do
                            </button>
                        </a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> No, I don't
                        </button>
                    </div>

                </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop