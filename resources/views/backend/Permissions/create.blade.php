@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Create a new permission</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Add a new permission</h2>
        <h6>All fields are required</h6>
        <hr/>
        {!! Form::open(['route' => 'permissions.store']) !!}
        <div class="col-md-6 category">

            <div class="form-group">
                {!! Form::label('name', "permission Name:", []) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a permission name']) !!}
                @if($errors->has('name'))
                    <span class="error-msg">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('display_name', "display Name (what will be displayed to the person who holds it):", []) !!}
                {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Enter a display name name']) !!}
                @if($errors->has('display_name'))
                    <span class="error-msg">{{ $errors->first('display_name') }}</span>
                @endif
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-ok-sign"></span> Add the permission
                </button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
@stop