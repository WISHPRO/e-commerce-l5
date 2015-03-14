@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Admin - sub-categories</title>
@stop

@section('content')

    @if($subcategories->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">There are no sub-categories to display. Please <a
                                href="{{ action('Backend\SubCategoriesController@create') }}"> add some</a></p>
                </div>
                <br/>

                <p>Subcategories help group products in a specific category together. This will also be displayed in the
                    site's navigation bar, under their related category</p>
            </div>

        </div>

    @else
        <h3>Product sub-categories</h3>
        <p>Subcategories help group products in a specific category together. This will also be displayed in the site's
            navigation bar, under their related category</p>
        <p>A banner would serve as a mini-advertisement for a product in this subcategory</p>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="find a sub-category..">
                          <span class="input-group-btn">
                              <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-search"></span>
                              </button>
                         </span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ action('Backend\SubCategoriesController@create') }}">
                        <button class="btn btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Create new Subcategory
                        </button>

                    </a>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 20px">
                <!-- /input-group -->
                <div class="table-responsive">
                    <table id="userData" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Banner</th>
                            <th>Category</th>
                            <th>Date created</th>
                            <th>Date Modified</th>
                        </tr>
                        </thead>
                        @foreach($subcategories as $subcategory)
                            <tbody>

                            <tr>
                                <td>
                                    <a href="{{ action('Backend\SubCategoriesController@show', ['id' => $subcategory->id]) }}">
                                        {{ beautify($subcategory->name) }}
                                    </a>
                                </td>
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
                                            <button class="btn btn-default btn-xs"><span
                                                        class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
                                            </button>
                                        </a>

                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top">
                                        <a href="#" data-toggle="modal" data-target="#deleteSubCategory">
                                            <button class="btn btn-warning btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>

                            </tbody>
                            @include('_partials.modals.displayImage', ['elementID' => 'subcategoryImage', 'model' => $subcategory, 'property' => 'banner'])
                            @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteSubCategory', 'route' => route('backend.subcategories.destroy', ['id' => $subcategory->id])])
                        @endforeach
                    </table>

                    {!! $subcategories->render() !!}
                </div>
            </div>
        </div>
    @endif


@stop