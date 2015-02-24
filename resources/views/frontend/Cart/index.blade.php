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
	    <div class="row empty-cart-message">
		    <div class="col-md-6 col-xs-12 alert alert-warning">
			    <h1>Your Shopping cart is Empty</h1>
			    <p>Search for products, check out our top brands or just visit the {!! link_to_route('home', 'homepage')!!} to get started</p>
			    <br/>
			    <p>If you have an account, {!! link_to_route('login', 'Sign In') !!} to view your cart</p>
		    </div>
	    </div>
    </div>
@stop