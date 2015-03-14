@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Counties</title>
@stop

@section('content')
    @if($counties->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">There counties to display. Please <a
                                href="{{ action('Backend\CountiesController@create') }}"> add some</a></p>
                </div>
                <br/>
                <p>Counties will serve as a guide to the user, about which locations the products they buy will be shipped
                    to</p>
            </div>
        </div>
    @endif
    <h3>All counties</h3>
    <p>Counties will serve as a guide to the user, about which locations the products they buy will be shipped to</p>
    <p>Once you add a county to this list, the user may use it as a shipping destination</p>
    <hr/>
    <div class="row">

        <div class="col-md-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a county..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="pull-right">
                <a href="{{ action('Backend\CountiesController@create') }}">
                    <button class="btn btn-success">
                        <i class="fa fa-plus"></i>&nbsp;Add county
                    </button>
                </a>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 20px">
            <!-- /input-group -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Short name</th>
                        <th>Date created</th>
                        <th>Date Modified</th>
                    </tr>
                    </thead>
                    @foreach($counties as $county)
                        <tbody>
                        <tr>
                            <td>{{ $county->name }}</td>
                            @if(empty($county->alias))
                                <td>None</td>
                            @else
                                <td>{{ $county->alias }}</td>
                            @endif
                            <td>{{ $county->created_at }}</td>
                            <td>{{ $county->updated_at }}</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ action('Backend\CountiesController@edit', ['id' => $county->id]) }}">
                                        <button class="btn btn-default btn-xs"><span
                                                    class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;Edit
                                        </button>
                                    </a>

                                </p>
                            </td>
                            <td>
                                <p data-placement="top">
                                    <a href="#" data-toggle="modal" data-target="#deleteCounty">
                                        <button class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                        </button>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteCounty', 'route' => route('backend.counties.destroy', ['id' => $county->id])])
                        </tbody>
                    @endforeach
                </table>
                {{ $counties->render() }}
            </div>

        </div>
    </div>
@stop

@section('scripts')
    @parent
    {{--{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js') }}--}}
@stop