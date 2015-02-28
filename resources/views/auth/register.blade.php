@extends('layouts.frontend.master')

@section('head')
	@parent
	{!! HTML::style('assets/css/vendor/formvalidation/formValidation.min.css') !!}
	<title>Registration</title>
@stop

@section('breadcrumbs')
@stop

@section('slider')
@stop

@section('content')
	<div class="container-fluid">
		<div class="row authentication">
			<div class="auth-container">
				<p class="text-muted text-center">Take a few minutes to create an account now. Your information will safely be secured with us to save you time, next time.</p>
				<br/>
				<p class="text text-info text-center">*All fields are required</p>
				<hr/>
				<form action="{{ route('registration.store') }}" method="POST" id="registrationForm">
					{!! generateCSRF() !!}
					<div class="col-md-4 col-md-offset-2 col-xs-12 r1">
						<div class="form-group">
							<label for="first_name">First Name:</label>
							<input type="text" id="first_name" class="form-control" maxlength="20" placeholder="Enter your first name" required value="{{ old('first_name') }}">
							@if($errors->has('first_name'))
								<span class="error-msg">{{ $errors->first('first_name') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="last_name">Second Name:</label>
							<input type="text" id="last_name" class="form-control" maxlength="20" placeholder="Enter your second name" required value="{{ old('last_name') }}">
							@if($errors->has('last_name'))
								<span class="error-msg">{{ $errors->first('last_name') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="county_id">Select your county:</label>
							{!! Form::select('county_id', str_replace('_', ' ', App\Models\County::lists('name', 'id')), null,  [ 'class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							<label for="town">Hometown: </label>
							<input type="text" id="town" class="form-control" maxlength="20" placeholder="It should exist within your selected county" required>
							@if($errors->has('town'))
								<span class="error-msg">{{ $errors->first('town') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="home_address">Home Address (where you live):</label>
							<textarea id="home_address" rows="4" placeholder="Enter your home address" maxlength="100" required class="form-control"></textarea>
							@if($errors->has('home_address'))
								<span class="error-msg">{{ $errors->first('home_address') }}</span>
							@endif
						</div>

					</div>
					<div class="col-md-4 col-xs-12 r2">
						<div class="form-group">
							<label for="phone">Phone number:</label>
							<div class="input-group">
								<span class="input-group-addon">+254</span>
								<input type="text" id="phone" placeholder="712345678" maxlength="9" required value="{{ old('phone') }}" class="form-control">
							</div>
							@if($errors->has('phone'))
								<span class="error-msg">{{ $errors->first('phone') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="email">Email Address:</label>
							<input type="email" id="email" class="form-control" placeholder="Enter email address" required value="{{ old('email') }}">
							@if($errors->has('email'))
								<span class="error-msg">{{ $errors->first('email') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" id="password" class="form-control" maxlength="20" placeholder="Enter your password" required value="{{ old('password') }}">
							@if($errors->has('password'))
								<span class="error-msg">{{ $errors->first('password') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="password_confirmation">Repeat your password:</label>
							<input type="password" id="password_confirmation" class="form-control" maxlength="20" placeholder="Repeat your password" required value="{{ old('password_confirmation') }}">
							@if($errors->has('password_confirmation'))
								<span class="error-msg">{{ $errors->first('password_confirmation') }}</span>
							@endif
						</div>
						<div class="field-row form-group">
							<input type="checkbox" name="accept">

							<span>I agree to the <a href="{{ route('terms') }}" target="_blank">Terms and conditions</a> </span>
							<br/>
							@if($errors->has('accept'))
								<span class="error-msg">{{ $errors->first('accept') }}</span>
							@endif
						</div>

						<button class="btn btn-info btn-lg" type="submit">
							Create My Account
						</button>

					</div>
				</form>

			</div>
		</div>

	</div>
@endsection

@section('brands')
@stop

@section('scripts')
	@parent
	{!! HTML::script('assets/js/vendor/formvalidation/formValidation.min.js') !!}
	{!! HTML::script('_bootstrap.min.js') !!}
	{!! HTML::script('assets/js/validation.js') !!}
@stop