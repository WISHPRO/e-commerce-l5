<div class="form-group">
    {!! Form::label('name', "Brand Name:", []) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a brand name']) !!}
    @if($errors->has('name'))
        <span class="error-msg">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('logo', "Select a logo, that represents the manufacturer/brand. must be in PNG format (MAX SIZE, 1MB):", []) !!}
    {!! Form::file('logo', ['class' => 'form-control']) !!}
    @if($errors->has('logo'))
        <span class="error-msg">{{ $errors->first('logo') }}</span>
    @endif
</div>