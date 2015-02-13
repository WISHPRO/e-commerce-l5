@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Admin - System Roles</title>
@stop

@section('content')
    @if($permissions->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">You currently have not configured any permissions. Please <a
                        href="{{ route('permissions.create') }}"> create some</a></p>
        </div>
    @endif
    <h4>Here are all the current system permissions</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a system permission..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ route('permissions.create') }}">
                    <button class="btn btn-success btn-sm fa fa-pencil"></button>
                </a>
            </div>

            <div class="table-responsive">
                <table id="userData" class="table table-bordred table-striped">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="checkall"/></th>
                        <th>Role Name</th>
                        <th>Date created</th>
                        <th>Date Modified</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>{{ $permission->updated_at }}</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ route('permissions.edit', ['id' => $permission->id]) }}">
                                        <button class="btn btn-primary btn-xs"><span
                                                    class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </a>

                                </p>
                            </td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal"
                                            data-target="#delete"><span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $permissions->render() }}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    {{--{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js') }}--}}
@stop