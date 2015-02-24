<div class="col-sm-12 col-xs-12 col-md-5 col-md-offset-1" style="margin-top: 8px">
    {!! Form::open(['route' => 'client.search', 'method' => 'get']) !!}
    <div class="input-group">
        {!! Form::text('q', null, ['class' => 'search-query form-control', 'placeholder' => 'find a product by name, description or product #']) !!}

        <div class="input-group-btn">
            <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    {!! Form::close() !!}
</div>