@extends('layouts.backend.master')

@section('header')
    @parent
    {{--{{ HTML::style('//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css') }}--}}
    <title>Advertisements</title>
@stop

@section('content')
    @if($ads->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">There are no advertisements to display. Please <a
                                href="{{ route('backend.ads.create') }}"> add some</a></p>
                </div>
            </div>
            <br/>

            <p>Ads will allow you to market your content</p>
        </div>
    @else
        <h3>Advertisements</h3>
        <p>Ads/advertisements allow the user to engage with your brand/site, hence increasing site traffic and eventual
            revenue</p>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="find an advert">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
                </div>
            </div>
            <!-- /input-group -->

            <div class="pull-right">
                <a href="{{ route('backend.ads.create') }}">
                    <button class="btn btn-success">
                        <i class="fa fa-plus"></i>&nbsp;Add advertisement
                    </button>
                </a>
            </div>

            <div class="col-md-12" style="margin-top: 20px">
                <div class="table-responsive">
                    <table id="userData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ad description</th>
                            <th>Related Product</th>
                            <th>Date created</th>
                            <th>Date Modified</th>
                        </tr>
                        </thead>
                        @foreach($ads as $ad)
                            <tbody>
                            <tr>
                                <td>
                                    {!! $ad->description !!}
                                </td>
                                <td>
                                    {{ $ad->product->name }}
                                </td>
                                @if(is_null(date($ad->created_at)))
                                    <td>N/A</td>
                                @else
                                    <td>{{ $ad->created_at }}</td>
                                @endif
                                <td>{{ $ad->updated_at }}</td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <a href="{{ action('Backend\AdvertisementsController@edit', ['id' => $ad->id]) }}">
                                            <button class="btn btn-default btn-xs"><span
                                                        class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                            </button>
                                        </a>

                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top">
                                        <a href="#" data-toggle="modal" data-target="#deleteAdd">
                                            <button class="btn btn-warning btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                            @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteAdd', 'route' => route('backend.ads.destroy', ['id' => $ad->id])])
                            </tbody>
                        @endforeach
                    </table>
                    {!! $ads->render() !!}
                </div>
            </div>

            @endif
        </div>
@stop

@section('scripts')
    @parent
    {{--{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js') }}--}}
@stop