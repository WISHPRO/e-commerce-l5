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
        <div class="col-md-4">
            <?php $product = array_get($data, 'product')?>
            <?php $user = array_get($data, 'user') ?>
            <h2>Hello and welcome to PC-World</h2>

            <p>
                {{ $user->getUserName() }} wants you to take a look at this awesome product that is on sale at our
                e-commerce site
            </p>

            <div class="row">
                <a href="">

                </a> <img src="{{ asset($product->image) }}" class="img-responsive img-thumbnail product-img">
                <hr/>
                {{ $product->name }}

                <div class="rating-reviews m-t-10">
                    <?php $reviewCount = $product->getSingleProductReviewCount(); ?>
                    @if(empty($reviewCount))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="rating rateit-small rateit">
                                    <span class="text text-primary bold">Rating:&nbsp;</span>
                                    <!-- http://ecomm.pc-world.com/products/52#comments-tab -->
                                    <span class="text text-info">Not reviewed Yet</span>
                                </div>
                            </div>
                        </div><!-- /.row -->
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <?php $stars = $product->getAverageRating(); ?>
                                <div class="rating">
                                    <span class="text text-primary bold">Rating:&nbsp;</span>
                                    <input type="hidden" class="rating" readonly data-fractions="2"
                                           value={{ $stars }}/>
                                                            <span class="text text-info">
                                                                <a href="#reviews" class="lnk">({{ $reviewCount }})
                                                                    reviews</a>
                                                            </span>
                                </div>
                            </div>
                        </div>

                        @endif
                                <!-- /.row -->
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="price-box">
                            @if(!$product->hasDiscount())
                                <span class="price">
                                                         
                                    {{ $product->getPrice() }}
                                                        </span>
                            @else
                                <span class="price-strike">
                                                            
                                    {{ $product->getPrice() }}
                                                        </span>
                                &nbsp;
                                <span class="price">
                                                         
                                    {{ $product->calculateDiscount(true)}}
                                                        </span>

                                <div class="savings">
                                    You save: {{ $product->discount }} &percnt;
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <br/>

        </div>

    </div>

</div>
