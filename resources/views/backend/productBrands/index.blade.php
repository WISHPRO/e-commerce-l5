@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Admin - Product brands</title>
@stop

@section('content')
    @if($brands->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">There are no product brands to display. Please <a
                        href="{{ route('brands.create') }}"> add some</a></p>
        </div>
    @endif
    <h4>Here are all the product Brands</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a product brand..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ route('brands.create') }}">
                    <button class="btn btn-success btn-sm fa fa-pencil"></button>
                </a>
            </div>

            <div class="table-responsive">
                <table id="userData" class="table table-bordred table-striped">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="checkall"/></th>
                        <th>Name of Brand</th>
                        <th>logo</th>
                        <th>current Product count</th>
                        <th>Date created</th>
                        <th>Date Modified</th>
                    </tr>
                    </thead>
                    @foreach($brands as $brand)
                        <tbody>

                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td>{{ ucwords(str_replace('_', ' ', $brand->name)) }}</td>
                            @if(is_null($brand->logo))
                                <td>None</td>
                            @else
                                <td>
                                    <a href="#" id="img" data-toggle="modal" data-target="#viewImg">
                                        <span class="glyphicon glyphicon-eye-open"></span> View banner
                                    </a>

                                    <div class="modal fade" id="viewImg" tabindex="-1" role="dialog"
                                         aria-labelledby="delete"
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <img src="{{ fileIsAvailable($brand->logo) ? asset($brand->logo) : asset(env('IMG_ERROR')) }}" />
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                            @endif
                            @if(is_null($brand->products->count()))
                                <td>None</td>
                            @else
                                <td>{{ $brand->products->count() }}</td>
                            @endif
                            @if(is_null(date($brand->created_at)))
                                <td>N/A</td>
                            @else
                                <td>{{ $brand->created_at }}</td>
                            @endif
                            <td>{{ $brand->updated_at }}</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ route('brands.show', ['id' => $brand->id]) }}">
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
                {!! $brands->render() !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    {{--{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js') }}--}}
@stop