@extends('layouts.backend.master')

@section('header')
    @parent
    <title>Admin - All Products</title>
@stop

@section('content')

    @if($products->isEmpty())
        <div class="alert alert-danger">
            <p class="text-center">There entire product catalog is empty. Please <a
                        href="{{ route('products.create') }}"> add some products</a></p>
        </div>
    @endif
    <h4>All products</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group custom-search-form" style="width: 300px; margin-top: 5px">
                <input type="text" class="form-control" placeholder="find a product..">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
            </div>
            <!-- /input-group -->

            <div class="pull-right" style="right: 10px">
                <a href="{{ route('products.create') }}">
                    <button class="btn btn-success btn-sm fa fa-pencil" data-title="Create" data-toggle="modal"
                            data-target="#create">
                    </button>
                </a>

            </div>

            <div class="table-responsive">
                <table id="data" class="table table-bordred table-hover">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="checkall"/></th>
                        <th>Name</th>
                        <th>sub-category</th>
                        <th>Category</th>
                        <th>Manufacturer</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Final price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td>{{ $product->name }}</td>

                            @foreach($product->subcategories as $pr)
                                <td>{{ $pr->name !== null ? ucwords(str_replace('_', ' ', $pr->name)) : "None" }}</td>
                            @endforeach

                            @foreach($product->categories as $pr)
                                <td>{{ $pr->name !== null ? $pr->name : "None" }}</td>
                            @endforeach

                            @foreach($product->brands as $pr)
                                <td>{{ $pr->name !== null ? $pr->name : "None" }}</td>
                            @endforeach

                            <td>{{ $product->price }}</td>
                            @if(empty($product->discount))
                                <td>N/A</td>
                            @else
                                <td>{{ $product->discount }}</td>
                            @endif
                            @if(empty($product->discount))
                                <td>{{ $product->price }}</td>
                            @else
                                <td>{{ calculateDiscount($product, true) }}</td>
                            @endif
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <a href="{{ route('products.show', ['id' => $product->id]) }}">
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
                {!! $products->render() !!}
            </div>
        </div>
    </div>
@stop