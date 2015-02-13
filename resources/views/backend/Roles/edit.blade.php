@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Edit System Roles</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Modify a system role</h2>
        <h6>Only the name field is required</h6>
        <hr/>
        {!! Form::model($role,['route' => ['roles.update', 'id' => $role->id], 'method' => 'put']) !!}
        <div class="col-md-6">

            <div class="form-group">
                {!! Form::label('name', "Role Name:", []) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a role name']) !!}
                @if($errors->has('name'))
                    <span class="error-msg">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('date_created', "Date the role was created:", []) !!}
                <p>{{ $role->created_at }}</p>
            </div>
            <div class="form-group">
                {!! Form::label('date_updated', "Date the role was last updated:", []) !!}
                <p>{{ $role->updated_at }}</p>
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
                    {!! Form::open(['route' => ['roles.delete', 'id' => $role->id], 'method' => 'delete']) !!}
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>
                            The role, and its related permissions will be deleted. Are you sure ?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left">
                            <a href="#">
                                <button class="btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-remove-sign"></span> Yes
                                </button>
                            </a>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> No
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