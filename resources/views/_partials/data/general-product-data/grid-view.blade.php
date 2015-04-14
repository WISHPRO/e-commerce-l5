<div class="tab-pane" id="grid-container">
    <div class="category-product  inner-top-vs">
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4  animated">
                    <div class="products">
                        <div class="product">
                            <div class="product-image m-b-20">
                                <div class="image">
                                    <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                        <img src="{{ getLargeAJAXImage() }}"
                                             class="img-responsive img-thumbnail product-image-general"
                                             data-echo={{ display_img($product) }}>
                                    </a>
                                </div>
                                <!-- /.image -->

                                @if($product->isNew())
                                    <div class="tag new">
                                        <span>new</span>
                                    </div>
                                @endif
                                @if($product->isHot())
                                    <div class="tag hot">
                                        <span>Hot</span>
                                    </div>
                                @endif
                            </div>
                            <!-- /.product-image -->
                            <div class="product-info text-left">
                                <h5>
                                    <a href="{{ route('product.view', ['id' => $product->id, 'name' => preetify($product->name)]) }}">
                                        {{ $product->name }}
                                    </a>
                                </h5>

                                <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                                @if(!empty($reviewCount))
                                    <?php $stars = $product->getAverageRating(); ?>
                                    <div class="rating">
                                        <input type="hidden" class="rating" readonly
                                               data-fractions="2" value={{ $stars }}/>
                                                                            <span class="text text-info">
                                                                                ({{ $product->getSingleProductReviewCount() }} {{ $reviewCount > 1 ? str_plural('review') : str_singular('review') }}
                                                                                )
                                                                            </span>
                                    </div>
                                @else
                                    <div class="rating">
                                        <span class="text text-muted">Rating: </span>
                                        <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                        <span class="text text-info">(Not rated Yet)</span>
                                    </div>
                                @endif
                                <div class="product-price m-t-10 m-b-10">
                                    @if(!$product->hasDiscount())
                                        <span class="price">{{ $product->getPrice() }}</span>
                                    @else
                                        <span class="discounted-product-old-price">{{  $product->getPrice() }}</span>
                                        &nbsp;
                                        <span class="price">{{ $product->getPriceAfterDiscount() }}</span>
                                    @endif
                                </div>
                                <div class="description m-t-10 product-desc">
                                    {!! $product->description_short !!}

                                </div>
                            </div>
                            <!-- /.product-info -->
                            <div class="cart clearfix animate-effect">
                                <div class="action m-t-10">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            {!! Form::open(['route' => ['cart.add', $product->id], 'id' => 'addToCart']) !!}
                                            {!! Form::input('hidden', 'qt', $product->quantity) !!}
                                            <button type="submit"
                                                    class="btn btn-primary">
                                                <i class="glyphicon glyphicon-shopping-cart inner-right-vs"></i>
                                                ADD TO CART
                                            </button>
                                            {!! Form::close() !!}

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>