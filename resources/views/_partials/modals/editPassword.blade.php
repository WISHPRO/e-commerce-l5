<div class="modal" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID. "Label" }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">Reset your password here: </h4>
            </div>
            <div class="modal-body">
                    <p>Ensure that you provide a strong password. A strong password should consist of be at least 6 characters in length, and consist of symbols, letters and numbers</p>
                    <p class="bold">Note: The changes will be effected the next time you login</p>
                    <hr/>
                    <form role="form" method="POST" action="{{ route('account.password.edit') }}" id="simplePasswordResetForm">
                        <input type="hidden" name="_method" value="PATCH">
                        {!! generateCSRF() !!}
                        <div class="form-group">
                            <label for="password">New password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Enter your new password" required>
                            @if($errors->has('password'))
                                <span class="error-msg">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repeat new password:</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" placeholder="Repeat your new password" required>
                            @if($errors->has('password_confirmation'))
                                <span class="error-msg">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="field-row form-group">
                            <input type="checkbox" name="logMeOut">
                            <span>Log me out, when am done (optional)</span>
                            <br/>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save new password</button>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
            </div>
        </div>
    </div>
</div>