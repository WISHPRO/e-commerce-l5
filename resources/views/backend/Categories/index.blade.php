@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Categories</title>
@stop

@section('content')
    @if($categories->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">There are no categories to display. Please <a
                                href="{{ route('backend.categories.create') }}"> add some</a></p>
                </div>
            </div>
            <br/>

            <p>Categories help to group similar products</p>
        </div>
    @else
        <h3>Product Categories</h3>
        <p>Categories help to group similar products. This categories listed below will be displayed on the site's
            navigation bar</p>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="find a product category..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('backend.categories.create') }}">
                        <button class="btn btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Create Category
                        </button>
                    </a>
                </div>
            </div>
            <hr/>
            <div class="col-md-12" style="margin-top: 20px">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
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
                                <td>
                                    <a href="{{ action('Backend\CategoriesController@show', ['id' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                </td>
                                @if(empty($category->alias))
                                    <td>None</td>
                                @else
                                    <td>{{ $category->alias }}</td>
                                @endif
                                @if(empty($category->banner))
                                    <td>None</td>
                                @else
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#displayBanner{{ $category->id }}">
                                            <button class="btn btn-success btn-xs">
                                                <span class="fa fa-eye"></span>&nbsp;View banner
                                            </button>
                                        </a>
                                    </td>
                                @endif
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <a href="{{ action('Backend\CategoriesController@edit', ['id' => $category->id]) }}">
                                            <button class="btn btn-default btn-xs">
                                                <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
                                            </button>
                                        </a>

                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top">
                                        <a href="#" data-toggle="modal"
                                           data-target="#deleteCategory{{ $category->id }}">
                                            <button class="btn btn-warning btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                            @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteCategory'.$category->id, 'route' => route('backend.categories.destroy', ['id' => $category->id])])
                            @include('_partials.modals.displayImage', ['elementID' => 'displayBanner'.$category->id, 'model' => $category, 'property' => 'banner'])
                            </tbody>
                        @endforeach
                    </table>
                    {!! $categories->render() !!}
                </div>
            </div>
            @endif
        </div>

@stop