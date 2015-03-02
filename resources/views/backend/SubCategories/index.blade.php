@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Admin - sub-categories</title>
@stop

@section('content')
    @if($subcategories->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">There are no sub-categories to display. Please <a
                        href="{{ action('Backend\SubCategoriesController@create') }}"> add some</a></p>
        </div>
    @else
        <h4>Here are all the product sub-categories</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="find a sub-category..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
                </div>
                <!-- /input-group -->

                <div class="pull-right">
                    <a href="{{ action('Backend\SubCategoriesController@create') }}">
                        <button class="btn btn-success btn-sm fa fa-pencil"></button>
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="userData" class="table table-bordred table-striped">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall"/></th>
                            <th>Sub-Category Name</th>
                            <th>Banner</th>
                            <th>Category</th>
                            <th>Date created</th>
                            <th>Date Modified</th>
                        </tr>
                        </thead>
                        @foreach($subcategories as $subcategory)
                            <tbody>

                            <tr>
                                <td><input type="checkbox" class="checkthis"/></td>
                                <td>{{ beautify($subcategory->name) }}</td>
                                @if(empty($subcategory->banner))
                                    <td>None</td>
                                @else
                                    <td>
                                        <a href="#" id="img" data-toggle="modal" data-target="#viewImg">
                                            <span class="glyphicon glyphicon-eye-open"></span> View banner
                                        </a>
                                    </td>
                                @endif
                                <td>{{ beautify($subcategory->category->name) }}</td>
                                <td>{{ $subcategory->created_at }}</td>
                                <td>{{ $subcategory->updated_at }}</td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <a href="{{ action('Backend\SubCategoriesController@edit', ['id' => $subcategory->id]) }}">
                                            <button class="btn btn-primary btn-xs"><span
                                                        class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                        </a>

                                    </p>
                                </td>
                            </tr>

                            </tbody>
                            <div class="modal fade" id="viewImg" tabindex="-1" role="dialog" aria-labelledby="delete"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <img src="{{ displayImage($subcategory, 'banner')}}"/>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                    </table>

                    {!! $subcategories->render() !!}
                </div>
            </div>
        </div>
    @endif
@stop