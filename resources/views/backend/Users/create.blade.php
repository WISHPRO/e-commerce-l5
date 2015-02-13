@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Create User</title>
@stop

@section('content')

    <div class="row admin-form">
        <h4>Add a new User</h4>
        <hr/>
        {!! Form::open(['route' => 'users.store']) !!}
        @include('_partials.users_form')
        <div class="row">
            <div class="col-md-4 pull-right">
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-ok-sign"></span> Create User
                    </button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop
