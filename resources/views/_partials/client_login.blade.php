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
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">Password reset</h4>
            </div>
            <div class="modal-body">
                <p>Enter your email address and we'll send you a recovery link, that will allow you to reset your password.</p>
                <hr/>
                <form role="form" method="POST" action="{{ route('reset.postEmail') }}" id="forgotPassword">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="Enter your email address" required>
                        @if($errors->has('email'))
                            <span class="error-msg">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Send reset link &nbsp;
                        <i class="fa fa-envelope"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('_partials.modals.session-remmember')
@include('_partials.modals.secure-message')