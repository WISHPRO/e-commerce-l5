@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Create a new advertisement</title>
@stop

@section('content')
    <div class="row admin-form">
        <h2>Add a new advertisement</h2>
        <hr/>
        {!! Form::open(['url' => action('Backend\AdvertisementsController@store'), 'files' => true]) !!}
        <div class="col-md-6 category">

            @include('_partials.forms.advertisements.advert')
            <hr/>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok-sign"></span> create
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop