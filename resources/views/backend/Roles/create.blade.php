@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Create a new system role</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Add a new role</h2>
        <h6>Only the name field is required</h6>
        <hr/>
        {!! Form::open(['route' => 'roles.store']) !!}
        <div class="col-md-6 category">

            <div class="form-group">
                {!! Form::label('name', "Role Name:", []) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a role name']) !!}
                @if($errors->has('name'))
                    <span class="error-msg">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-ok-sign"></span> Add the role
                </button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
@stop