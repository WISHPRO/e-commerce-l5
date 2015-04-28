{!! isset($heading) ? "<h3>Sign In to your account</h3><hr/>" : "" !!}
@if(api_login_enabled())

    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{ route('auth.loginUsingAPI', ['api' => 'facebook']) }}">
                <button class="btn btn-info m-b-10">
                    <i class="fa fa-facebook-official pull-left fa-2x"></i>&nbsp;
                    <span class="pull-right">Sign in using my <br/>facebook account</span>
                </button>
            </a>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
            <a href="{{ route('auth.loginUsingAPI', ['api' => 'google']) }}">
                <button class="btn btn-danger">
                    <i class="fa fa-google-plus pull-left fa-2x"></i>&nbsp;
                    <span class="pull-right">Sign in using my <br/>google account</span>
                </button>
            </a>
        </div>
    </div>

    <div class="strike m-t-10 m-b-10">
        <span>or, use our sign-in service</span>
    </div>


@endif
<form role="form" method="POST" action="{{ route('login.verify') }}" id="loginForm">
    {!! Form::token() !!}
    <div id="login-form-ajax-result"></div>
    <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" class="form-control"
               placeholder="Enter your email address" required>
        @if($errors->has('email'))
            <span class="wow flash error-msg">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password"
               placeholder="Enter your password" data-toggle="password" required>
        @if($errors->has('password'))
            <span class="wow flash error-msg">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me&nbsp;
                <a href="#" data-toggle="modal" data-target="#sessionInfoModal">
                    <i class="fa fa-question-circle"></i>
                </a>
            </label>
            <label class="pull-right">
                <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">I forgot my password
                </a>
            </label>
        </div>

    </div>
    @if(isset($recaptcha))
        <p class="text text-danger">We've detected unusual request activity from your IP address
            of {{ Request::getClientIp() }}. You'll need to prove that you're not a robot</p>
        @include('_partials.forms.authentication.recaptcha')
    @endif
    <br/>
    <button type="submit" class="btn btn-primary {{ $extra_class }}"><i class="fa fa-sign-in"></i>&nbsp;Sign
        in
    </button>
    <hr/>
    @if(Request::isSecure() & !isset($display_security_assurance))
        <a href="#" data-toggle="modal" data-target="#infoModal">
            <i class="fa fa-lock help-glyph fa-2x"></i>&nbsp;{{ "Login is always safe and secure" }}
        </a>
    @endif
</form>
@include('_partials.modals.help.forgotPassword', ['elementID' => 'forgotPasswordModal'])
@include('_partials.modals.help.session-remember')
@include('_partials.modals.help.secure-message')