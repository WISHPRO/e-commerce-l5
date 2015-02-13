<div class="form-group">
    {!! Form::label('password', "New Password:", []) !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter a new password']) !!}
    @if($errors->has('password'))
        <span class="error-msg">{{ $errors->first('password') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', "Confirm new password:", []) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'repeat the new password']) !!}
    @if($errors->has('password_confirmation'))
        <span class="error-msg">{{ $errors->first('password_confirmation') }}</span>
    @endif
</div>