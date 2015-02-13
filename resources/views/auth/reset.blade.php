@extends('layouts.shared.auth')

@section('content')

	<div class="container-fluid">
		<div class="row auth-form">
			<div class="ref-logo">
				<a href="{{ route('home') }}">
					<div class="pull-left">
						{!! HTML::image('assets/images/logo.png', 'PC WORLD') !!}
					</div>
				</a>
			</div>
			<br/>
			<hr/>
			<div class="col-md-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title"><strong>Please Sign In </strong></h2>
						</div>
						<div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" action="{{ route('reset.finish') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="token" value="{{ $token }}">

								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail Address</label>
									<div class="col-md-6">
										<input type="email" class="form-control" name="email" value="{{ old('email') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Confirm Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password_confirmation">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">
											Reset Password
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

		</div>
	</div>
	</div>
@stop