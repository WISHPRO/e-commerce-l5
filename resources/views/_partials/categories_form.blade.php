<div class="form-group">
    {!! Form::label('name', "Category Name:", []) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a category name']) !!}
    @if($errors->has('name'))
        <span class="error-msg">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('alias', "Category Alias (just a short name):", []) !!}
    {!! Form::text('alias', null, ['class' => 'form-control', 'placeholder' => 'Enter a category alias']) !!}
    @if($errors->has('alias'))
        <span class="error-msg">{{ $errors->first('alias') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('banner', "Select an image; like an advert to represent the category (MAX SIZE, 2MB):", []) !!}
    {!! Form::file('banner', ['class' => 'form-control']) !!}
    @if($errors->has('banner'))
        <span class="error-msg">{{ $errors->first('banner') }}</span>
    @endif
</div>