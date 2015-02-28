@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - System Roles</title>
@stop

@section('content')
    @if($roles->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">You currently have not configured any roles. Please <a
                        href="{{ action('Backend\RolesController@create') }}"> create some</a></p>
        </div>
    @endif
    <h4>Here are all the current system roles</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a system role..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ action('Backend\RolesController@create') }}">
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
                    @foreach($roles as $role)
                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ action('Backend\RolesController@edit', ['id' => $role->id]) }}">
                                        <button class="btn btn-primary btn-xs"><span
                                                    class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </a>

                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $roles->render() }}
            </div>
        </div>
    </div>

@stop