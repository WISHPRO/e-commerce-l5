<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', "Product Name:", []) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a product name']) !!}
        @if($errors->has('name'))
            <span class="error-msg">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('category_id', "Category:", []) !!}
        {!! Form::select('category_id', str_replace('_', ' ', App\Models\Category::lists('name', 'id')), $product->categories()->where('product_id', $product->id)->first()->pivot->category_id,  [ 'class'=>'form-control', 'id' => 'cat', 'onchange' => 'getSelectedOption()']) !!}
        @if($errors->has('category_id'))
            <span class="error-msg">{{ $errors->first('category_id') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('sub_category_id', "Sub category:", []) !!}
        {!! Form::select('sub_category_id', str_replace('_', ' ', App\Models\SubCategory::lists('name', 'id')), /*result = testCondition ? value1 : value2*/$product->subcategories()->where('product_id', $product->id)->first()->pivotsub_category_id, [ 'class' => 'form-control']) !!}
        @if($errors->has('sub_category_id'))
            <span class="error-msg">{{ $errors->first('sub_category_id') }}</span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('brand_id', "Product manufacturer:", []) !!}
        {!! Form::select('brand_id', App\Models\Brand::lists('name', 'id'), $product->brands()->where('product_id', $product->id)->first()->pivot->brand_id, [ 'class'=>'form-control']) !!}
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
    <div class="form-group">
        {!! Form::label('warranty_period', "Warranty (months):", []) !!}
        {!! Form::text('warranty_period', null, ['class' => 'form-control', 'placeholder' => 'e.g 24']) !!}
        @if($errors->has('warranty_period'))
            <span class="error_msg">{{ $errors->first('warranty_period') }}</span>
        @endif
    </div>
    <div class="row">
        <h2>Current product Image</h2>
        @if(checkIfFileExists($product->image))
            <div class="current-image">
                <img src="{{ displayImage($product) }}" class="img-responsive img-thumbnail">
            </div>
        @else
            <div>
                <p class="text text-center">
                    NONE
                </p>
            </div>
        @endif
        <p class="m-t-10">You can upload a new image here</p>
        @if($errors->has('image'))
            <p class="error_msg">{{ $errors->first('image') }}</p>
        @endif
        <div class="input-group image-preview m-t-10">
            <input type="text" class="form-control image-preview-filename" name="image" id="image" disabled="disabled">
            <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg" name="image"/> <!-- rename it -->
                    </div>
                    <br/>
                </span>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<h2>Product Descriptions</h2>
<div class="row m-t-10 m-b-20">
    <div class="col-md-5">
        <div class="form-group">
            <label for="editor_small">Short product description</label>
        <textarea name="description_short" id="editor_small" cols="15"
                  rows="5">{{ $product->description_short }}</textarea>
            @if($errors->has('description_short'))
                <span class="error-msg">{{ $errors->first('description_short') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-7">
        <div class="form-group">
            <label for="editor">Long product description</label>
            <textarea name="description_long" id="editor" cols="30"
                      rows="10">{{ $product->description_long }}</textarea>
            @if($errors->has('description_long'))
                <span class="error-msg">{{ $errors->first('description_long') }}</span>
            @endif
        </div>
    </div>
</div>