@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Search</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="col-md-6">
                <div class="alert alert-info alert-dismissable" id="dismiss">
                    <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip"
                            data-placement="top" title="dismiss message">&times;</button>
                    <p class="text text-center">Sorry. We found 0 products matching '{{ Request::get('q') }}'</p>
                </div>

                <p>Possible solutions</p>
                <ol class="list-group">
                    <li>
                        Try reducing the length of your search query, for better results
                    </li>
                    <li>
                        Try searching for a product by its specs, color, storage, etc
                        eg. to find a laptop with an i3 cpu, your can try searching for 'i3"
                    </li>
                    <li>

                    </li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    {!! HTML::script('assets/js/vendor/bootstrap/bootstrap-rating.min.js') !!}
@stop