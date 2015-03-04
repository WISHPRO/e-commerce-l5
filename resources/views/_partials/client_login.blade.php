<form role="form" method="POST" action="{{ route('login.verify') }}" id="loginForm">
    {!! generateCSRF() !!}
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
                <input type="checkbox" name="remember"> Remember Me
            </label>
            <label class="pull-right">
                <a href="{{ route('password.reset') }}">I forgot my password
                </a>
            </label>
        </div>

    </div>
    <br/>
    <button type="submit" class="btn btn-primary btn-lg btn-block {{ $extra_class }}"><i class="fa fa-sign-in"></i>&nbsp;Sign
        in
    </button>
    <hr/>
    @if(Request::isSecure())
        <a href="#" data-toggle="modal" data-target="#infoModal">
            <i class="fa fa-lock help-glyph fa-2x"></i>&nbsp;security guaranteed
        </a>
    @endif
</form>
@include('_partials.modals.secure-message')