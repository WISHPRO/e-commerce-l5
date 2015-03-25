@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Your Account</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container m-b-40 m-t-20">
        @include('_partials.modals.editUserProfile', ['elementID' => 'editPersonal'])
        <div class="row user-account">
            <div class="col-md-6 col-md-offset-3 p-all-10 account-info">
                <h3>{{ beautify($user->first_name) . '\'s' }} Account</h3>
                <hr/>
                <div class="alert alert-info">
                    <p>Personal info</p>
                </div>
                <p>This section displays your personal information. You can add more information about yourself using the button provided below</p>


                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th class="bold">Your Name:</th>
                            <td>{{ $user->getUserName() }}</td>
                        </tr>
                        <tr>
                            <th class="bold">County:</th>
                            <td>{{ !empty($user->county) ? beautify($user->county->name) : "None" }}</td>
                        </tr>
                        @if(!empty($user->avatar))
                            <tr>
                                <th class="bold">
                                    Avatar:
                                </th>
                                <td>
                                    <img src="{{ asset($user->avatar) }}" class="img-circle" style="height: 80px; width: 80px;">
                                </td>
                            </tr>
                        @endif
                        @if(!empty($user->gender))
                            <tr>
                                <th class="bold">
                                    Gender:
                                </th>
                                <td>
                                    {{ $user->gender }}
                                </td>
                            </tr>
                        @endif
                        @if(!empty($user->dob))
                            <tr>
                                <th class="bold">
                                    Date of birth:
                                </th>
                                <td>
                                    {{ $user->dob }}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                <div class="row account-data-buttons">
                    <div class="pull-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#AddMorePersonal"><i
                                    class="fa fa-plus-square"></i>&nbsp;Add extra details
                        </button>
                    </div>
                    <div class="pull-left">
                        <button class="btn btn-info" data-toggle="modal" data-target="#editPersonal"><i
                                    class="fa fa-edit"></i>&nbsp;Edit
                        </button>
                    </div>
                </div>
                <hr/>

                <div class="alert alert-info">
                    Shipping Information
                </div>
                <p>This section displays location specific details about yourself. This information is used to be used
                    to ship products to your destination. You can add more destinations using the links provided</p>


                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th class="bold">County:</th>
                            <td>{{ !empty($user->county) ? beautify($user->county->name) : "None" }}</td>
                        </tr>
                        <tr>
                            <th class="bold">Town:</th>
                            <td>{{ beautify($user->town) }}</td>
                        </tr>
                        <tr>
                            <th class="bold">Home address:</th>
                            <td>{{ beautify($user->home_address) }}</td>
                        </tr>
                        </tbody>
                    </table>

                <div class="row account-data-buttons">
                    <div class="pull-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#AddNewShipping"><i
                                    class="fa fa-plus-square"></i>&nbsp;Add Shipping destination
                        </button>
                    </div>
                    <div class="pull-left">
                        <button class="btn btn-info" data-toggle="modal" data-target="#editShippingInfo"><i
                                    class="fa fa-edit"></i>&nbsp;Edit
                        </button>
                    </div>
                </div>

                <hr/>
                <div class="alert alert-info">
                    <p>Contact Information</p>
                </div>
                <p>Use this section to edit your contact information. Your mobile number will be used to contact you,
                    only when you order a product</p>


                    <table class="table table-bordered">
                        <tr>
                            <th class="bold">Email address:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="bold">Mobile number:</th>
                            <td>{{ beautify($user->phone) }}</td>
                        </tr>
                    </table>

                <button class="btn btn-info" data-toggle="modal" data-target="#editContactInfo"><i
                            class="fa fa-edit"></i>&nbsp;Edit
                </button>

                <hr/>

                <div class="alert alert-info">
                    <p>Account Security</p>
                </div>
                <p>This section displays various related security options about your account</p>

                <div class="well">
                    <button class="btn btn-info" data-toggle="modal" data-target="#editPassword"><i
                                class="fa fa-edit"></i>&nbsp;Edit password
                    </button>
                </div>

                <hr/>
                <p>Proceed with caution</p>
                <a href="{{ route('account.delete') }}">
                    <button class="btn btn-danger"><i class="fa fa-remove"></i>&nbsp;Delete my Account</button>
                </a>

            </div>

        </div>
    </div>
    @include('_partials.modals.editPassword', ['elementID' => 'editPassword'])
    @include('_partials.modals.editContactInfo', ['elementID' => 'editContactInfo'])
    @include('_partials.modals.editShippingInfo', ['elementID' => 'editShippingInfo'])
@stop