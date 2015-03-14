@extends('layouts.backend.master')

@section('header')
    @parent
    <title>My Account</title>
@stop

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h3>{{ $user->getUserName() }} - Account</h3>
        </div>
    </div>
@stop