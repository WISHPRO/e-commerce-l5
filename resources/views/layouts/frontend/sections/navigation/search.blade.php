<div class="col-xs-12 col-sm-8 col-md-4" style="margin-top: 8px">
    {!! Form::open(['route' => 'client.search', 'method' => 'get']) !!}
    <div class="input-group">
        {!! Form::text('q', null, ['class' => 'search-query form-control', 'placeholder' => 'search for a product...', 'id' => 'mainSearchForm']) !!}

        <div class="input-group-btn">
            <button class="btn btn-info" onclick="return s();" type="submit"><i
                        class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        function s() {
            var el = document.getElementById("mainSearchForm");
            if (!el.value.trim()) {
                el.focus();
                return false;
            }
        }
    </script>
</div>