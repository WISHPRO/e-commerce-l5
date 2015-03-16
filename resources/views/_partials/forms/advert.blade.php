<div class="form-group">
    {!! Form::label('ad_representation_id', "Mode of representation:", []) !!}
    {!! Form::select('ad_representation_id', str_replace('_', ' ', App\Models\adsRepresentation::lists('name', 'id')), null, [ "class" => "form-control ads-mode" ]) !!}
    @if($errors->has('ad_representation_id'))
        <span class="error-msg">{{ $errors->first('ad_representation_id') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('product_id', "Select a product:", []) !!}
    {!! Form::select('product_id', App\Models\Product::lists('name', 'id'), null, [ "class" => "form-control advert-products" ]) !!}
    @if($errors->has('product_id'))
        <span class="error-msg">{{ $errors->first('product_id') }}</span>
    @endif
</div>

<hr/>
<h2>Advert Description</h2>

<div class="form-group">
    <label for="editor_small">This will overlay the image</label>
        <textarea name="description" id="editor_small" cols="15"
                  rows="5">{{ old('description') }}</textarea>
    @if($errors->has('description'))
        <span class="error-msg">{{ $errors->first('description') }}</span>
    @endif
</div>
<br/>

<label for="image">Advert Image</label>

<div class="input-group image-preview">
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
                        <input type="file" accept="image/png, image/jpeg" name="input-file-preview"/> <!-- rename it -->
                    </div>
                    <br/>
                    @if($errors->has('image'))
                        <span class="error_msg">{{ $errors->first('image') }}</span>
                    @endif
                </span>
</div>

<br/>





