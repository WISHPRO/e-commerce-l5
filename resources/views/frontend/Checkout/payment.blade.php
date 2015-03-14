@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp;&middot;&nbsp;Checkout</title>
@stop

@section('main-nav')

@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')

@stop

@section('footer')
    <div class="container checkout-wizard">
        <div class="row bs-wizard" style="border-bottom:0;">
            @include('_partials.checkout-progress.step1', ['state' => 'complete'])
            @include('_partials.checkout-progress.step2', ['state' => 'complete'])
            @include('_partials.checkout-progress.step3', ['state' => 'active'])
            @include('_partials.checkout-progress.step4')
        </div>
        <hr/>
        <div class="row" id="step-3">
            <div class="col-md-12">
                <h3>Payment information</h3>

                <div class="col-md-6 m-b-10">
                    <div class="row shipping-info">

                        <div class="alert alert-info">
                            <h4>Payment:</h4>

                            <p>Use any of the payment methods below</p>
                        </div>
                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#paymentReward" aria-expanded="false" aria-controls="paymentReward">
                            Redeem promo code / voucher
                        </button>
                        <div class="collapse m-t-10" id="paymentReward">
                            <div class="well">
                                <p>Have a voucher or promo code? redeem them here.</p>

                                <form class="form-inline m-b-15" id="promoRedeem">
                                    <div class="form-group">
                                        <label for="promoCode">Promo code:&nbsp;</label>
                                        <input type="text" class="form-control" id="promoCode">
                                    </div>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form>
                                <form class="form-inline" id="voucherRedeem">
                                    <div class="form-group">
                                        <label for="voucherCode">Voucher code:</label>
                                        <input type="text" class="form-control" id="voucherCode">
                                    </div>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form>
                            </div>
                        </div>
                        <hr/>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#paymentMPESA"
                                aria-expanded="false" aria-controls="paymentMPESA">
                            Pay via M-PESA
                        </button>
                        <div class="collapse m-t-10" id="paymentMPESA">
                            <div class="well">
                                <p>This Feature has not been implemented yet. Sorry for the inconvenience.</p>

                                <p>You can use the other methods of payment we've provided</p>
                            </div>
                        </div>
                        <hr/>

                        <h4>Pay with Credit/Debit Card</h4>

                        <div class="m-t-10" id="paymentVisa">
                            <div class="well">
                                <form accept-charset="UTF-8" action="/" class="require-validation"
                                      data-cc-on-file="false"
                                      data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form"
                                      method="post">
                                    <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden"
                                                                                          value="✓"/><input
                                                name="_method" type="hidden" value="PUT"/><input
                                                name="authenticity_token" type="hidden"
                                                value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8="/></div>
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label' for="cardName">Name on Card</label>
                                            <input id="cardName" name="cardName" class='form-control' size='4'
                                                   type='text' required>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group card required'>
                                            <label class='control-label' for="cardNo">Card Number</label>
                                            <input id="cardNo" name="cardNo" autocomplete='off' class='form-control'
                                                   size='20' type='text' required>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-xs-4 form-group cvc required'>
                                            <label for="cvc" class='control-label'>CVC</label>
                                            <input id="cvc" name="cvc" autocomplete='off' class='form-control'
                                                   placeholder='ex. 311' size='4' type='text'>
                                        </div>
                                        <div class='col-xs-4 form-group expiration required'>
                                            <label class='control-label'>Expiration</label>
                                            <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                                   type='text'>
                                        </div>
                                        <div class='col-xs-4 form-group expiration required'>
                                            <label class='control-label'> </label>
                                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                   type='text'>
                                        </div>
                                    </div>


                                    <div class='form-row'>
                                        <div class='col-md-12 form-group'>

                                            <button class='form-control btn btn-success submit-button' disabled><span
                                                        class="badge">Your total today: $300</span></button>
                                            <button class='form-control btn btn-primary submit-button' type='submit'>
                                                Pay »
                                            </button>

                                        </div>
                                    </div>

                                    <div class='form-row'>
                                        <div class='col-md-12 error form-group hide'>
                                            <div class='alert-danger alert'>
                                                Please correct the errors and try again.
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p>We support the following payment methods</p>

                            <div>
                                <i class="fa fa-cc-stripe fa-2x" title="stripe"></i>
                                <i class="fa fa-cc-visa fa-2x" title="visa"></i>
                                <i class="fa fa-cc-paypal fa-2x" title="paypal"></i>
                                <i class="fa fa-google-wallet fa-2x" title="google wallet"></i>
                                <i class="fa fa-cc-mastercard fa-2x" title="mastercard"></i>
                            </div>
                        </div>
                        <hr/>
                        <button class="btn btn-primary btn-lg">Proceed to order review page</button>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2 pull-right shipping-info">
                    @include('_partials.forms.order-summary')
                </div>
            </div>
        </div>
    </div>
@stop