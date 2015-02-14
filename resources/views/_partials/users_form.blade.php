<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <h6>Enter a first name, eg Antony</h6>
            {!! Form::label('first_name', "First Name:", []) !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'firstname']) !!}
            @if($errors->has('first_name'))
                <span class="error-msg">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <h6>Enter a last name, eg chacha</h6>
            {!! Form::label('last_name', "Last Name:", []) !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'lastname']) !!}
            @if($errors->has('last_name'))
                <span class="error-msg">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <h6>With this, the user will be able to use the backend</h6>
            {!! Form::label('employee_id', "Employee ID, eg " . mt_rand(1000, 9999), []) !!}
            {!! Form::text('employee_id', null, ['class' => 'form-control', 'placeholder' => 'Enter, if any']) !!}
            @if($errors->has('employee_id'))
                <span class="error-msg">{{ $errors->first('employee_id') }}</span>
            @endif
        </div>
        <div class="form-group">
            <h6>Incase you need to contact them</h6>
            {!! Form::label('phone', "Phone Number:", []) !!}
            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter a phone number']) !!}
            @if($errors->has('phone'))
                <span class="error-msg">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class="form-group">
            <h6>Pick a county</h6>
            {!! Form::label('county', "County:", []) !!}
            {!! Form::select('county', app\Models\County::lists('name', 'id'), null, ['class' => 'form-control']) !!}
            @if($errors->has('county'))
                <span class="error-msg">{{ $errors->first('county') }}</span>
            @endif
        </div>
        <div class="form-group">
            <h6>Enter a town</h6>
            {!! Form::label('town', "Home town:", []) !!}
            {!! Form::text('town', null, ['class' => 'form-control', 'placeholder' => 'Enter a town..eg nairobi']) !!}
            @if($errors->has('town'))
                <span class="error-msg">{{ $errors->first('town') }}</span>
            @endif
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group">
            <h6>Their home address</h6>
            {!! Form::label('home_address', "Home address:", []) !!}
            {!! Form::textarea('home_address', null, ['rows' => '2', 'class' => 'form-control', 'placeholder' => 'Enter a random home address']) !!}
            @if($errors->has('home_address'))
                <span class="error-msg">{{ $errors->first('home_address') }}</span>
            @endif
        </div>
        <div class="form-group">
            <h6>Their email address</h6>
            {!! Form::label('email_address', "Email Address:", []) !!}
            {!! Form::text('email_address', null, ['class' => 'form-control', 'placeholder' => 'Enter a email address']) !!}
            @if($errors->has('email_address'))
                <span class="error-msg">{{ $errors->first('email_address') }}</span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('password', "Password:", []) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'just assign a random password']) !!}
            @if($errors->has('password'))
                <span class="error-msg">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', "Password confirmation:", []) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'repeat the password']) !!}
            @if($errors->has('password_confirmation'))
                <span class="error-msg">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
    </div>
</div>
