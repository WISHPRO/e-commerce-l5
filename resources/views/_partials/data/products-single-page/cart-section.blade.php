<div class="product-social-link text-right">
    <div class="social-icons">
        <ul class="list-inline">
            <li>
                <span class="social-label">Share :</span>
            </li>

            <li><a class="fa fa-facebook" href="#"></a></li>
            <li><a class="fa fa-twitter" href="#"></a></li>
            <li><a class="glyphicon glyphicon-envelope" href="#"></a></li>
            <li><a class="fa fa-pinterest" href="#"></a></li>
        </ul>
        <!-- /.social-icons -->
    </div>
    <hr/>

    <table class="table table-responsive">
        {!! Form::open(['route' => ['cart.add', $product->id], 'class' => 'addToCart']) !!}
        <tr>
            <th>
                Qty:
            </th>
            <td>

                @if($product->quantity <= config('site.products.quantity.max_selectable', 10))
                    {!! Form::selectRange('quantity', 1, $product->quantity, 1, ['class' => 'form-control pull-left', 'style' => 'width:80px']) !!}
                @else
                    <input name="quantity" type="number" min="1"
                           max="{{ $product->quantity }}" class="form-control pull-left"
                           style="width: 80px">
                @endif
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                @if(!$product->hasDiscount())
                    <span class="price bold-lg pull-right">{{ $product->getPrice() }}</span>
                @else
                    <span class="discounted-product-old-price pull-left">{{  $product->getPrice() }}</span>
                    &nbsp;
                    <span class="price bold-lg pull-right">{{ $product->getPriceAfterDiscount() }}</span>

                    <hr/>
                    <div class="m-t-5">
                        <p class="text text-left ">
                            You save: {{ $product->getDiscountRate(true) }} ({{ $product->getDiscountAmount() }})
                        </p>

                    </div>
                @endif
            </td>
        </tr>
        <tr class="m-t-40">
            <th></th>
            <td>
                @if($product->quantity <= config('site.products.quantity.low_threshold', 2))
                    <div class="alert alert-warning">
                        <p class="text text-justify"><i class="fa fa-warning"></i>&nbsp;This product
                            is almost running out of stock.</p>
                    </div>
                @endif
                {!! Form::input('hidden', 'qt', $product->quantity) !!}
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="glyphicon glyphicon-shopping-cart inner-right-vs"></i> ADD TO CART
                </button>
            </td>
        </tr>
        {!! Form::close() !!}
    </table>
</div>