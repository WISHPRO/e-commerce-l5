@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Admin - Product brands</title>
@stop

@section('content')
    @if($brands->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">There are no product brands to display. Please <a
                                href="{{ action('Backend\BrandsController@create') }}"> add some</a></p>
                </div>
            </div>
            <br/>
            <p>Brands allow the user to identify a product to a specific manufacturer. An example of a brand is Nokia, Samsung, etc</p>
        </div>
    @else
        <h3>Product Brands</h3>
        <p>Brands allow the user to identify a product to a specific manufacturer. All brands present are listed below</p>
        <p>Each brand has a logo, for easy identification</p>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="find a product brand..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
                </div>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ action('Backend\BrandsController@create') }}">
                    <button class="btn btn-success">
                        <i class="fa fa-plus"></i>&nbsp;Add product Brand
                    </button>
                </a>
            </div>

            <div class="col-md-12 m-t-20">
                <div class="table-responsive">
                    <table id="userData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name of Brand</th>
                            <th>Product count</th>
                            <th>Date created</th>
                            <th>Date Modified</th>
                        </tr>
                        </thead>
                        @foreach($brands as $brand)
                            <tbody>
                            <tr>
                                <td>
                                    <a href="{{ route('backend.brands.show', ['id' => $brand->id]) }}">
                                        {{ beautify($brand->name) }}
                                    </a>
                                </td>
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
                                        <a href="{{ action('Backend\BrandsController@edit', ['id' => $brand->id]) }}">
                                            <button class="btn btn-default btn-xs"><span
                                                        class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
                                            </button>
                                        </a>

                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top">
                                        <a href="#" data-toggle="modal" data-target="#deleteBrand">
                                            <button class="btn btn-warning btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                            @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteBrand', 'route' => route('backend.brands.destroy', ['id' => $brand->id])])
                            </tbody>
                        @endforeach
                    </table>
                    {!! $brands->render() !!}
                </div>
            </div>

            @endif
        </div>
@stop

@section('scripts')
    @parent
    {{--{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js') }}--}}
@stop