@extends('layouts.shared.auth')

@section('content')

	<div class="container-fluid">
		<div class="row auth-form">
			<a href="{{ route('login') }}" data-toggle="tooltip"
			   data-placement="bottom" title="go back to login page">
				<span class="fa fa-backward fa-2x"></span> Back
			</a>
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
					@if (isset($status))
						<div class="alert alert-success">
							<p>{{ $status }}</p>
						</div>
					@endif
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">Enter your Email address, and we will send you a password reset link</h2>
						</div>
						<div class="panel-body">
							<form role="form" class="form-horizontal" method="POST" action="{{ route('reset.postEmail') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail Address:</label>
									<div class="col-md-6">
										<input type="email" class="form-control" name="email" value="{{ old('email') }}">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-success">
											Send Password Reset Link
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="copyright">
				<p class="text-center">&copy; PC-World, {{ date('Y') }}</p>
			</div>

		</div>
	</div>
@stop