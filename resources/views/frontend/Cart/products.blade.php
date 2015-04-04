@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>View Shopping cart</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="container">
        <h1>Your Shopping cart</h1>

        <p>Review your items below. Change them as needed, and when ready, just press the 'checkout' button</p>

        <div class="row">
            <div class="col-md-12 m-b-20">
                <table class="table table-bordered">

                    <thead>
                    <tr>
                        <th>
                            <h4>Image</h4>
                        </th>
                        <th>
                            <h4>Name</h4>
                        </th>
                        <th>
                            <h4>Qty</h4>
                        </th>
                        <th>
                            <h4>Price</h4>
                        </th>
                        <th>
                            <h4>SubTotal</h4>
                        </th>
                        <th>
                            <h4>
                                Actions
                            </h4>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->products as $product)
                        <tr>
                            <td>
                                <img src="{{ displayImage($product) }}" class="img-responsive"
                                     style="height: 50px; width: 50px">
                            </td>
                            <td>

                                {{ $product->name }}
                                <br/>
                                <span class="text text-muted bold">SKU:&nbsp;</span> {{ $product->sku }}
                                <br/>
                                <ul>{!! $product->description_short !!}</ul>

                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', ['id' => $product->id]) }}"
                                      class="form-horizontal updateCart" role="form">
                                    <input type="hidden" name="_method" value="PATCH">
                                    {!! generateCSRF() !!}
                                    <input name="quantity" type="number"
                                           value="{{ $cart->getSingleProductQuantity($product) }}"
                                           min="1" max="{{ $product->quantity }}" class="form-control pull-left"
                                           style="width: 70px" required>
                                    {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                    <button class="btn btn-info btn-sm pull-right" type="submit"
                                            data-toggle="tooltip" data-placement="top" data-original-title="update cart"
                                            style="margin-top: 2px">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </form>

                            </td>
                            <td>
                                {{ $product->getPrice() }}
                            </td>

                            <td>
                                {{ $product->formatMoneyValue($product->value($product, $cart->getSingleProductQuantity($product))) }}
                            </td>
                            <td>
                                <form method="POST" action="{{ route('cart.update.remove', ['id' => $product->id]) }}"
                                      class="form-horizontal removeFromCart">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {!! generateCSRF() !!}
                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip"
                                            data-placement="top" data-original-title="remove from cart">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <hr/>
            <div class="col-md-4 col-md-offset-8">
                <h4 class="pull-right">
                    Total: {{ $cart->getSubTotal() }}
                </h4>
            </div>

        </div>

    </div>
@stop