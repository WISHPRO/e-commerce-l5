<div class="modal fade" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID . 'Label'}}" aria-hidden="true">
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