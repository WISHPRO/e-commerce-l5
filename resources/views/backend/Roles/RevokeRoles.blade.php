@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Revoke roles from a user</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Revoke roles</h2>
        <h6>select a user from the dropdown, and uncheck any of the roles you want to revoke</h6>
        <hr/>
        {{ Form::open(['route' => 'roles.revoke.remove']) }}
        <div class="col-md-6 category">

            <div class="form-group">
                {{ Form::label('user_id', "Select a user. For multiple users, you'll need to repeat this procedure:", []) }}
                {{ Form::select('user_id', str_replace('_', ' ', User::whereNotNull('employee_id')->lists('user_name', 'id')), [ 'class'=>'form-control']) }}
                @if($errors->has('user_id'))
                    <span class="error-msg">{{ $errors->first('user_id') }}</span>
                @endif

            </div>
            {{--{{ User::whereNotNull('employee_id')->lists('user_name', 'id') }}--}}
            <div class="form-group">
                {{ Form::label('roles', "This user has the following roles. uncheck those you dont want the user to have:", []) }}
                <br/>
                @foreach($users as $user)
                    @foreach(Role::where('user_id', $user->id)->lists('name', 'id') as $user_role)
                        {{ Form::checkbox('roles[]', $user_role->id, true, ['class' => 'form-group']) }}

                        <p>{{ str_replace('_', ' ', $user_role->name) }}</p>
                    @endforeach
                @endforeach

                @if($errors->has('roles'))
                    <span class="error-msg">{{ $errors->first('roles') }}</span>
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
        {{ Form::close() }}
    </div>
@stop