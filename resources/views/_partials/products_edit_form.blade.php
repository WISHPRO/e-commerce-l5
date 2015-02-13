<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('name', "Product Name:", []) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a product name']) !!}
        @if($errors->has('name'))
            <span class="error-msg">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <script>
        function getSelectedOption() {
            var e = document.getElementById("cat");
            return e.options[e.selectedIndex].value;
        }

    </script>
    <div class="form-group">
        {!! Form::label('category_id', "Category:", []) !!}
        {!! Form::select('category_id', str_replace('_', ' ', Category::lists('name', 'id')), $product->categories()->where('product_id', $product->id)->first()->pivot->category_id,  [ 'class'=>'form-control', 'id' => 'cat', 'onchange' => 'getSelectedOption()']) !!}
        @if($errors->has('category_id'))
            <span class="error-msg">{{ $errors->first('category_id') }}</span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('sub_category_id', "Sub category:", []) !!}
        {!! Form::select('sub_category_id', str_replace('_', ' ', SubCategory::lists('name', 'id')), /*result = testCondition ? value1 : value2*/$product->subcategories()->where('product_id', $product->id)->first()->pivotsub_category_id, [ 'class' => 'form-control']) !!}
        @if($errors->has('sub_category_id'))
            <span class="error-msg">{{ $errors->first('sub_category_id') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('brand_id', "Product manufacturer:", []) !!}
        {!! Form::select('brand_id', Brand::lists('name', 'id'), $product->brands()->where('product_id', $product->id)->first()->pivot->brand_id, [ 'class'=>'form-control']) !!}
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

</div>
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('image', "Product image. will be resized to 600*400px: ", []) !!}
        {!! Form::file('image', ['class' => 'form-control']) !!}
        @if($errors->has('image'))
            <span class="error-msg">{{ $errors->first('image') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('processor', "Processor :", []) !!}
        {!! Form::text('processor', null, ['class' => 'form-control', 'placeholder' => '(type, speed, etc)']) !!}
        @if($errors->has('processor'))
            <span class="error-msg">{{ $errors->first('processor') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('memory', "RAM (GB)", []) !!}
        {!! Form::text('memory', null, ['class' => 'form-control', 'placeholder' => 'specify its RAM, if any']) !!}
        @if($errors->has('memory'))
            <span class="error-msg">{{ $errors->first('memory') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('warranty_period', "Warranty (months):", []) !!}
        {!! Form::text('warranty_period', null, ['class' => 'form-control', 'placeholder' => 'e.g 24']) !!}
        @if($errors->has('warranty_period'))
            <span class="error_msg">{{ $errors->first('warranty_period') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('storage', "Storage space (GB):", []) !!}
        {!! Form::text('storage', null, ['class' => 'form-control', 'placeholder' => 'specify its storage capacity']) !!}
        @if($errors->has('storage'))
            <span class="error-msg">{{ $errors->first('storage') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('video_memory', "Video memory (GB):", []) !!}
        {!! Form::text('video_memory', null, ['class' => 'form-control', 'placeholder' => '2gb..']) !!}
        @if($errors->has('video_memory'))
            <span class="error-msg">{{ $errors->first('video_memory') }}</span>
        @endif
    </div>
</div>
<div class="col-md-4">

    <div class="form-group">
        {!! Form::label('operating_system', "Operating system:", []) !!}
        {!! Form::text('operating_system', null, ['class' => 'form-control', 'placeholder' => 'windows..']) !!}
        @if($errors->has('operating_system'))
            <span class="error-msg">{{ $errors->first('operating_system') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('colors_available', "Colors available: Eg red", []) !!}
        {!! Form::text('colors_available', null, ['class' => 'form-control', 'placeholder' => 'Enter a color']) !!}
        @if($errors->has('colors_available'))
            <span class="error-msg">{{ $errors->first('colors_available') }}</span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('description', "Product description:", []) !!}
        {!! Form::textarea('description', null, ['rows' => '4', 'class' => 'form-control', 'placeholder' => 'Enter anything that describes the product']) !!}
        @if($errors->has('description'))
            <span class="error-msg">{{ $errors->first('description') }}</span>
        @endif
    </div>
</div>
