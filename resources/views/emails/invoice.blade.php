<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<meta charset="UTF-8">
{!! HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css')!!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
{!! HTML::script('//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') !!}
{!! HTML::script('//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
<![endif]-->
<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
{!! HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css')!!}
{!! HTML::style('/css/mail/mail.css', [], true)!!}

<div class="container-fluid">
    <div class="row">
        <?php $user = array_get(array_flatten($data), '2')?>
        <?php $products = array_get(array_flatten($data), '3')?>
        <?php $order = array_get(array_flatten($data), '1')?>
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2>

                <h3 class="pull-right">Order # {{ $order->id }}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Invoice Billed To:</strong><br>
                        {{ $user->getUserName() }}<br>
                        {{ $user->county->name }}<br>
                        {{ $user->town }}<br>
                        {{ $user->home_address }}
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Products Shipped To:</strong><br>
                        {{ $user->getUserName() }}<br>
                        {{ $user->county->name }}<br>
                        {{ $user->town }}<br>
                        {{ $user->home_address }}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>

                        <p class="text text-info">#This is a test invoice. You did not pay for the product</p> <br>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        {{ $order->created_at }}<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->sku }}</td>
                                    <td class="text-center">{{ $product->getPrice(true) }}</td>
                                    {{--<td class="text-center">{{ $order->products->pivot->quantity }}</td>--}}
                                    <td class="text-right">{{ format_money($product->getPrice(false)) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">$670.99</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                <td class="no-line text-right">$15</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">$685.99</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>