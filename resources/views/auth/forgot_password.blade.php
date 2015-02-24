@extends('layouts.frontend.master')

@section('head')
	@parent
	{!! HTML::style('assets/css/vendor/formvalidation/formValidation.min.css') !!}
	<title>Forgot password</title>
@stop

@section('breadcrumbs')
@stop

@section('slider')
@stop

@section('content')

	<div class="container-fluid">
		<div class="row authentication">
			@if(is_null(session('status')))
			<div class="col-md-4 col-md-offset-2 col-sm-8 col-xs-12">
				<p>Forgot your account's password? Enter your email address and we'll send you a recovery link.</p>
				<form role="form" method="POST" action="{{ route('reset.postEmail') }}" id="resetAccount1">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">
						@if($errors->has('email'))
							<span class="error-msg">{{ $errors->first('email') }}</span>
						@endif
					</div>
					<button type="submit" class="btn btn-success btn-lg btn-block">Send reset link &nbsp;<i class="fa fa-envelope"></i> </button>
				</form>
			</div>
			@else
				<div class="col-md-4 col-md-offset-2 col-sm-8 col-xs-12 alert alert-success">
					<p class="bold">Account recovery email sent successfully to {{ Session::pull('email_address') }}</p>
					<br/>
					<p>
						If you don't see this email in your inbox within 15 minutes, look for it in your junk mail folder.
						If you find it there, please mark it as "Not Junk".
					</p>
					<br/>
					<a href="{{ route('home') }}">
						<button class="btn btn-info"><i class="fa fa-arrow-left"></i>&nbsp; Back to home page</button>
					</a>
				</div>
			@endif
		</div>
	</div>
@stop

@section('brands')
@stop