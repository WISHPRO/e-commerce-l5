<div class="modal" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID. "Label" }}"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::model($county, ['url' => action('Backend\CountiesController@update', ['id' => $county->id]), 'method' => 'PATCH', 'id' => 'countiesEditForm']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">Edit details of <strong>{{ $county->name }}</strong> county
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-ajax-result"></div>
                <div class="form-group">
                    {!! Form::label('name', "County Name:", []) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter a county name']) !!}
                    @if($errors->has('name'))
                        <span class="error-msg">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('alias', "County Alias (just a short name):", []) !!}
                    {!! Form::text('alias', null, ['class' => 'form-control', 'placeholder' => 'eg, NRB for nairobi']) !!}
                    @if($errors->has('alias'))
                        <span class="error-msg">{{ $errors->first('alias') }}</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
                <div class="pull-left">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok-sign"></span> Finish Edit
                    </button>
                    <span class="loading-image"><img src="{{ getAjaxImage() }}"> </span>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>