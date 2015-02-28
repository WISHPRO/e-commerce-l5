@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Modify Users</title>
@stop

@section('content')
    @if($users->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">There are no users registered on the site. Bad practise though, but for now, please
                <a href="{{ action('Backend\UsersController@create') }}"> add some</a></p>
        </div>
    @endif
    <h4>Here are all the users registered on the site</h4>
    <small>Note: its not a good idea to manually modify user data from the backend. For now, you can</small>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form" style="width: 300px; margin-top: 5px">
                <input type="text" class="form-control" placeholder="find a user..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right" style="right: 10px">
                <a href="{{ action('Backend\UsersController@create') }}">
                    <button class="btn btn-success btn-sm fa fa-pencil" data-title="Create" data-toggle="modal"
                            data-target="#create">
                    </button>
                </a>

            </div>

            <div class="table-responsive">
                <table id="userData" class="table table-bordred table-striped">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="checkall"/></th>
                        <th>User Name</th>
                        <th>Phone</th>
                        <th>County</th>
                        <th>Town</th>
                        <th>Home Address</th>
                        <th>Email</th>
                        <th>Activated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td>{{ $user->getUserName() }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->county->name }}</td>
                            <td>{{ $user->town }}</td>
                            <td>{{ $user->home_address }}</td>
                            <th>{{ $user->email }}</th>
                            @if($user->confirmed == 0)
                                <th>No</th>
                            @else
                                <th>yes</th>
                            @endif
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ action('Backend\UsersController@edit', ['id' => $user->id]) }}">
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
                {!! $users->render() !!}
            </div>
        </div>
    </div>
@stop