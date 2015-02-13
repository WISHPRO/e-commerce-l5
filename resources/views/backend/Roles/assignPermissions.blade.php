@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Assign permissions to a role</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Assign permissions to a role</h2>
        <h6>select a role from the dropdown, and check any of the permission checkboxes needed</h6>
        <hr/>
        {!! Form::open(['route' => 'roles.permissions.add']) !!}
        <div class="col-md-6 category">

            <div class="form-group">
                {!! Form::label('role_id', "Role:", []) !!}
                {!! Form::select('role_id', Role::lists('name', 'id'), [ 'class'=>'form-control']) !!}
                @if($errors->has('role_id'))
                    <span class="error-msg">{{ $errors->first('role_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('permissions', "Select one or more permissions. No descriptions are currently available:", []) !!}
                <br/>
                @foreach(Permission::all() as $perm)
                    {!! Form::checkbox('permissions[]', $perm->id, false, ['class' => 'form-group']) !!}

                    <p>{{ str_replace('_', ' ', $perm->name) }}</p>

                @endforeach
                @if($errors->has('permissions'))
                    <span class="error-msg">{{ $errors->first('permissions') }}</span>
                @endif
            </div>

        </div>

        <div class="">
            <a href="#" data-toggle="modal" data-target="#assign">
                <button class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-ok-sign"></span> Assign permissions
                </button>
            </a>
        </div>

        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="assign" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title text-center">You are adding permissions to a role</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info"><span class="glyphicon glyphicon-question-sign"></span>
                            Are you sure you want to do this?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- submit button -->
                        <div class="pull-left">
                            <a href="#">
                                <button class="btn btn-success" type="submit">
                                    <span class="glyphicon glyphicon-plus-sign"></span> Yes
                                </button>
                            </a>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-stop"></span> No
                            </button>
                        </div>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {!! Form::close() !!}
    </div>
@stop