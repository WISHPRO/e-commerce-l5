@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Admin - Categories</title>
@stop

@section('content')
    @if($categories->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">There are no categories to display. Please <a
                        href="{{ action('backend\CategoriesController@create')}}"> add some</a></p>
        </div>
    @endif
    <h4>Here are all the product categories</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a product category..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ route('categories.create') }}">
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
                        <th>Banner</th>
                        <th>Date created</th>
                        <th>Date Modified</th>
                    </tr>
                    </thead>
                    @foreach($categories as $category)
                        <tbody>

                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td>{{ $category->name }}</td>
                            @if(empty($category->alias))
                                <td>None</td>
                            @else
                                <td>{{ $category->alias }}</td>
                            @endif
                            @if(empty($category->banner))
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
                                                <img src="{{ displayImage($category, 'banner' )}}" />
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                            @endif
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ action('Backend\CategoriesController@edit', ['id' => $category->id]) }}">
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
                {!! $categories->render() !!}
            </div>
        </div>


    </div>
@stop

@section('scripts')
    @parent
    {{--{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js') }}--}}
@stop