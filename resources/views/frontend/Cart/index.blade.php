@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Empty Shopping cart</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container">
        <h1>Your Shopping cart is Empty</h1>
        <p>Search for items, or just visit the {!! link_to_route('home', 'homepage')!!} to get started</p>
        <br/>
        <p>If you have an account, {!! link_to_route('login', 'Sign In') !!} to view your cart</p>

    </div>
@stop