@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - Modify Users</title>
@stop

@section('content')
    @if($users->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">There are no users registered on the site. Please
                        <a href="{{ action('Backend\UsersController@create') }}"> add some</a></p>
                </div>
                <hr/>
                <p>This is not good</p>
            </div>
        </div>

    @endif
    <h3>System users</h3>
    <p>This are all users registered on the site</p>
    <hr/>
    <div class="row">
        <div class="col-md-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="find a user..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
        </div>

        <div class="col-md-8">
            <div class="pull-right">
                <a href="{{ action('Backend\UsersController@create') }}">
                    <button class="btn btn-success">
                        <i class="fa fa-user-plus"></i>&nbsp;Add User
                    </button>
                </a>
            </div>
        </div>
        <hr/>
        <div class="col-md-12" style="margin-top: 20px">
            <div class="table-responsive">
                <table class="table table-bordered" id="usersTable">
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Role(s)</th>
                        <th>Phone</th>
                        <th>County</th>
                        <th>Town</th>
                        <th>Home Address</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="{{ $user->id == Auth::id() ? 'info' : '' }}">
                            <td>
                                <a href="{{ action('Backend\UsersController@show', ['id' => $user->id]) }}">
                                    {{ $user->getUserName() }}
                                </a>
                            </td>
                            <td>
                                @if($user->roles->count() == 0)
                                    None
                                @else
                                    @foreach($user->roles as $role)
                                        {{ $role->name . ' ' }}
                                    @endforeach
                                    <br/>
                                @endif
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ empty($user->county) ? str_replace("'", '', 'None') : $user->county->name }}</td>
                            <td>{{ $user->town }}</td>
                            <td>{{ $user->home_address }}</td>
                            <th>{{ $user->email }}</th>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ action('Backend\UsersController@edit', ['id' => $user->id]) }}">
                                        <button class="btn btn-default btn-xs"><span
                                                    class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
                                        </button>
                                    </a>

                                </p>
                            </td>
                            <td>
                                <p data-placement="top">
                                    <a href="#" data-toggle="modal" data-target="#deleteUser">
                                        <button class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                        </button>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteUser', 'route' => route('backend.users.destroy', ['id' => $user->id])])
                    @endforeach
                    </tbody>
                </table>
                {!! $users->render() !!}
            </div>
        </div>

    </div>
@stop