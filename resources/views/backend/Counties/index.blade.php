@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Counties</title>
@stop

@section('content')
    @if($counties->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">There counties to display. Please <a
                        href="{{ action('Backend\CountiesController@create') }}"> add some</a></p>
        </div>
    @endif
    <h4>Here are all the counties</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a county..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ action('Backend\CountiesController@create') }}">
                    <button class="btn btn-success btn-sm fa fa-pencil"></button>
                </a>
            </div>

            <div class="table-responsive">
                <table id="userData" class="table table-bordred table-striped">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="checkall"/></th>
                        <th>Category Name</th>
                        <th>Alias</th>
                        <th>Date created</th>
                        <th>Date Modified</th>
                    </tr>
                    </thead>
                    @foreach($counties as $county)
                        <tbody>

                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
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
                                        <button class="btn btn-primary btn-xs"><span
                                                    class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </a>

                                </p>
                            </td>
                        </tr>


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