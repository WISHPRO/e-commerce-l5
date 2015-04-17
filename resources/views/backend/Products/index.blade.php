@extends('layouts.backend.master')

@section('header')
    @parent
    <title>All Products</title>
@stop

@section('content')

    @if($products->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <p class="text-center">The entire product catalog is empty. Please <a
                                href="{{ action('Backend\ProductsController@create') }}"> add some products</a></p>
                </div>
                <br/>

                <p>This defines what you sell to the user. You just cant have an empty product catalogue.</p>
            </div>
        </div>

    @else
        <h3>All products (Inventory)</h3>
        <p>Here is the full product catalogue</p>
        <p>Total inventory count (sum of all product quantities): <b>{{ $inventoryCount }}</b></p>
        <p>Products in inventory (sum of all individual products): <b>{{ $productsCount }}</b></p>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" id="products-search" placeholder="find a product..">
              <span class="input-group-btn">
              <button class="btn btn-primary" type="button">
                  <span class="glyphicon glyphicon-search"></span>
              </button>
             </span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="pull-right" style="right: 10px">
                    <a href="{{ action('Backend\ProductsController@create') }}">
                        <button class="btn btn-success" data-title="Create" data-toggle="modal"
                                data-target="#create">
                            <i class="fa fa-plus"></i>&nbsp;Add product
                        </button>
                    </a>

                </div>
            </div>
            <!-- /input-group -->
            <br/>

            <div class="col-md-12" style="margin-top: 20px;">
                <div class="table-responsive">
                    <table id="data" class="table table-bordered table-list-search">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Sub-category</th>
                            <th>Manufacturer</th>
                            <th>Qt</th>
                            <th>Price</th>
                            <th>Tax status</th>
                            <th>Discount (%)</th>
                            <th>Final price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>

                                <td>
                                    <a href="{{ route('backend.categories.show', ['id' => $product->categories->implode('id')]) }}">
                                        {{ $product->categories->implode('name') }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('backend.subcategories.show', ['id' => $product->subcategories->implode('id')]) }}">
                                        {{ $product->subcategories->implode('name') }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('backend.brands.show', ['id' => $product->brands->implode('id')]) }}">
                                        {{ $product->brands->implode('name') }}
                                    </a>
                                </td>
                                <td>
                                    {{ $product->quantity }}
                                </td>
                                <td>{{ $product->getPrice() }}</td>
                                @if($product->taxable)
                                    <td>TAXABLE</td>
                                @else
                                    <td>EXEMPTED</td>
                                @endif
                                @if($product->hasDiscount())
                                    <td>{{ $product->getDiscountRate() }}</td>
                                @else
                                    <td>None</td>
                                @endif
                                @if(!$product->hasDiscount())
                                    <td>{{ $product->getPrice() }}</td>
                                @else
                                    <td>{{ $product->getPriceAfterDiscount() }}</td>
                                @endif
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <a href="{{ action('Backend\ProductsController@edit', ['id' => $product->id]) }}">
                                            <button class="btn btn-primary btn-xs"><span
                                                        class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                            </button>
                                        </a>
                                    </p>
                                <td>
                                    <p data-placement="top">
                                        <a href="#" data-toggle="modal" data-target="#deleteProduct{{ $product->id }}">
                                            <button class="btn btn-warning btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                            @include('_partials.modals.actionModals.delete', ['elementID' => 'deleteProduct'.$product->id, 'route' => route('backend.products.destroy', ['id' => $product->id])])
                        @endforeach
                        </tbody>
                    </table>
                    {!! $products->render() !!}
                </div>
            </div>
            @endif
        </div>
@stop