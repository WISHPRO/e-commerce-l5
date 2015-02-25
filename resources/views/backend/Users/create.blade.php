@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Create User</title>
@stop

@section('content')

    <div class="row admin-form">
        <h4>Add a new User</h4>
        <hr/>
        {!! Form::open(['route' => 'backend.users.store']) !!}
            @include('_partials.users_form', ['submitButtonText' => 'Add user'])
        {!! Form::close() !!}
    </div>
@stop
