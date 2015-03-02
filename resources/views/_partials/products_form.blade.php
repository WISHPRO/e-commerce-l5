<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('name', "Product Name:", []) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a product name']) !!}
        @if($errors->has('name'))
            <span class="error-msg">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('category_id', "Category:", []) !!}
        {!! Form::select('category_id', str_replace('_', ' ', App\Models\Category::lists('name', 'id')), null, [ 'class'=>'form-control', 'id' => 'cat', 'onchange' => 'getSelectedOption()']) !!}
        @if($errors->has('category_id'))
            <span class="error-msg">{{ $errors->first('category_id') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('sub_category_id', "Sub category:", []) !!}
        {!! Form::select('sub_category_id', str_replace('_', ' ', App\Models\SubCategory::lists('name', 'id')), null, [ 'class' => 'form-control']) !!}
        @if($errors->has('sub_category_id'))
            <span class="error-msg">{{ $errors->first('sub_category_id') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('brand_id', "Product manufacturer:", []) !!}
        {!! Form::select('brand_id', App\Models\Brand::lists('name', 'id'), null, [ 'class'=>'form-control']) !!}
        @if($errors->has('brand_id'))
            <span class="error-msg">{{ $errors->first('brand_id') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('quantity', "Product quantity: (between 1 and 1000)", []) !!}
        {!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Enter the quantity']) !!}
        @if($errors->has('quantity'))
            <span class="error-msg">{{ $errors->first('quantity') }}</span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('price', "Product price: ", []) !!}
        {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'This is required']) !!}
        @if($errors->has('price'))
            <span class="error-msg">{{ $errors->first('price') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('discount', "Product Discount (percentage, eg 25.50). 0 is assumed if left blank: ", []) !!}
        {!! Form::text('discount', null, ['class' => 'form-control', 'placeholder' => 'Enter a discount, if any']) !!}
        @if($errors->has('discount'))
            <span class="error-msg">{{ $errors->first('discount') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('warranty_period', "Warranty (months):", []) !!}
        {!! Form::text('warranty_period', null, ['class' => 'form-control', 'placeholder' => 'e.g 24']) !!}
        @if($errors->has('warranty_period'))
            <span class="error_msg">{{ $errors->first('warranty_period') }}</span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('image', "Upload a new image here: ", []) !!}
        {!! Form::file('image', ['class' => 'form-control']) !!}
        @if($errors->has('image'))
            <span class="error-msg">{{ $errors->first('image') }}</span>
        @endif
    </div>
</div>
<div class="clearfix"></div>
<h2>Product Descriptions</h2>
<div class="col-md-5">
    <div class="form-group">
        <label for="editor_small">Short product description</label>
        <textarea name="description_short" id="editor_small" cols="15"
                  rows="5">{{ old('description_short') }}</textarea>
        @if($errors->has('description_short'))
            <span class="error-msg">{{ $errors->first('description_short') }}</span>
        @endif
    </div>
</div>
<div class="col-md-7">
    <div class="form-group">
        <label for="editor">Long product description</label>
        <textarea name="description_long" id="editor" cols="30" rows="10">{{ old('description_long') }}</textarea>
        @if($errors->has('description_long'))
            <span class="error-msg">{{ $errors->first('description_long') }}</span>
        @endif
    </div>
</div>


