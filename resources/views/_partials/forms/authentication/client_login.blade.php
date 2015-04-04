<h3>Login to your account</h3>
@if(api_login_enabled())
    <div>
        <div class="form-group m-t-20">
            <a href="{{ route('auth.loginUsingAPI', ['api' => 'facebook']) }}">
                <button class="btn btn-primary btn-block">
                    <i class="fa fa-facebook-official"></i>&nbsp;Login using my facebook account
                </button>
            </a>
        </div>
        <div class="form-group">
            <a href="#">
                <button class="btn btn-danger btn-block">
                    <i class="fa fa-google-plus"></i>&nbsp;Login using my google account
                </button>
            </a>
        </div>
        <div class="strike m-t-10 m-b-10">
            <span>or, use our login service</span>
        </div>
    </div>

@endif
<form role="form" method="POST" action="{{ route('login.verify') }}" id="loginForm">
    {!! generateCSRF() !!}
    <div id="login-form-ajax-result"></div>
    <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" class="form-control"
               placeholder="Enter your email address" required>
        @if($errors->has('email'))
            <span class="error-msg">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password"
               placeholder="Enter your password" required>
        @if($errors->has('password'))
            <span class="error-msg">{{ $errors->first('password') }}</span>
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
        <p class="text text-danger">We've detected unusual request activity from your IP address of {{ Request::getClientIp() }}. You'll need to prove that youre not a robot</p>
        @include('_partials.forms.authentication.recaptcha')
    @endif
    <br/>
    <button type="submit" class="btn btn-primary {{ $extra_class }}"><i class="fa fa-sign-in"></i>&nbsp;Sign
        in
    </button>

    <hr/>
    @if(Request::isSecure())
        <a href="#" data-toggle="modal" data-target="#infoModal">
            <i class="fa fa-lock help-glyph fa-2x"></i>&nbsp;security guaranteed
        </a>
    @endif
</form>
@include('_partials.modals.help.forgotPassword', ['elementID' => 'forgotPasswordModal'])
@include('_partials.modals.help.session-remmember')
@include('_partials.modals.help.secure-message')