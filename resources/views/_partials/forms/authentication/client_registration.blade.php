@if(api_registration_enabled())

    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{ route('auth.registerUsingAPI', ['api' => 'facebook']) }}">
                <button class="btn btn-info m-b-10">
                    <i class="fa fa-facebook-official pull-left fa-2x"></i>&nbsp;
                    <span class="pull-right">Register using my <br/>facebook account</span>
                </button>
            </a>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{ route('auth.registerUsingAPI', ['api' => 'google']) }}">
                <button class="btn btn-danger">
                    <i class="fa fa-google-plus pull-left fa-2x"></i>&nbsp;
                    <span class="pull-right">Register using my <br/>google account</span>
                </button>
            </a>
        </div>
    </div>
    <div class="strike m-t-10 m-b-10">
        <span>or, use our sign-up service</span>
    </div>
@endif
<br/>
<p class="text-info">*All fields are required</p>
<form action="{{ route('registration.store') }}" method="POST" id="registrationForm">
    {!! csrf_html() !!}
    <div class="m-t-10" id="registration-form-ajax-result"></div>
    <div class="form-group m-t-20">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" class="form-control" maxlength="20"
               placeholder="Enter your first name" value="{{ old('first_name') }}" required>
        @if($errors->has('first_name'))
            <span class="wow flash error-msg">{{ $errors->first('first_name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="last_name">Second Name:</label>
        <input type="text" id="last_name" name="last_name" class="form-control" maxlength="20"
               placeholder="Enter your second name" value="{{ old('last_name') }}" required>
        @if($errors->has('last_name'))
            <span class="wow flash error-msg">{{ $errors->first('last_name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="county_id">Select your county:</label>
        {!! Form::select('county_id', str_replace('_', ' ', App\Models\County::lists('name', 'id')), null,  [ 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="town">Hometown: </label>
        <input type="text" id="town" name="town" class="form-control" maxlength="20"
               placeholder="It should exist within your selected county" required>
        @if($errors->has('town'))
            <span class="wow flash error-msg">{{ $errors->first('town') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="home_address">Home Address (where you live):</label>
                            <textarea id="home_address" name="home_address" rows="4"
                                      placeholder="Enter your home address" maxlength="100" required
                                      class="form-control">{{ old('home_address') }}</textarea>
        @if($errors->has('home_address'))
            <span class="wow flash error-msg">{{ $errors->first('home_address') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="phone">Phone number:</label>

        <div class="input-group">
            <span class="input-group-addon">+254</span>
            <input type="text" id="phone" name="phone" placeholder="712345678" maxlength="9" required
                   value="{{ old('phone') }}" class="form-control">
        </div>
        @if($errors->has('phone'))
            <span class="wow flash error-msg">{{ $errors->first('phone') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" class="form-control"
               placeholder="Enter email address" value="{{ old('email') }}" required>
        @if($errors->has('email'))
            <span class="wow flash error-msg">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" maxlength="100" required
               placeholder="Enter your password" data-toggle="password">
        @if($errors->has('password'))
            <span class="wow flash error-msg">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="password_confirmation">Repeat your password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               class="form-control" maxlength="100" placeholder="Repeat your password" data-toggle="password" required>
        @if($errors->has('password_confirmation'))
            <span class="wow flash error-msg">{{ $errors->first('password_confirmation') }}</span>
        @endif
    </div>
    <div class="field-row form-group">
        <input type="checkbox" name="accept">

        <span>I agree to the <a href="{{ route('terms') }}" target="_blank">Terms and conditions</a> </span>
        <br/>
        @if($errors->has('accept'))
            <span class="wow flash error-msg">{{ $errors->first('accept') }}</span>
        @endif
    </div>
    @if(isset($recaptcha))
        <p class="text text-danger">We've detected unusual request activity from your IP address
            of {{ Request::getClientIp() }}. You'll need to prove that youre not a robot</p>
        @include('_partials.forms.authentication.recaptcha')
    @endif
    <button class="btn btn-primary btn-lg" type="submit">
        <i class="fa fa-plus"></i>&nbsp; Create My Account
    </button>
</form>