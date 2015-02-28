@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Contact us</title>
@stop

@section('breadcrumb')

    {{ Breadcrumbs::render() }}

@stop


@section('sidebar')

@stop

@section('slider')

@stop

@section('promo')

@stop


@section('content')

    <main id="contact-us" class="inner-bottom-md  wow fadeInUp animated">
        <section class="google-map map-holder">
            <div id="map">

            </div>

        </section>

        <div class="container  wow fadeInUp animated">
            <div class="row">

                <div class="col-md-8" id="msg-link">
                    <section class="section leave-a-message">
                        <h2>Wanna talk? We would love to hear from you</h2>

                        {{ Form::open(['url' => '#', 'id' => 'contact-form', 'class' => 'contact-form cf-style-1 inner-top-xs']) }}
                        <fieldset>
                            <legend>Please fill in the following form</legend>
                            <h6>Fields marked with * are required</h6>

                            <div class="row ">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="field-row">
                                        {{ Form::label('subject', 'Subject') }}

                                        {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter a message subject']) }}
                                        @if($errors->has('subject'))
                                            <span class="error-msg">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    {{ Form::label('email', 'Your Email *') }}

                                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email address']) }}
                                    @if($errors->has('email'))
                                        <span class="error-msg">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    {{ Form::label('user_name', 'Your Name') }}

                                    {{ Form::text('user_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your name']) }}
                                    @if($errors->has('user_name'))
                                        <span class="error-msg">{{ $errors->first('user_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-12">
                                    <div class="field-row">
                                        {{ Form::label('message', 'Your message *') }}

                                        {{ Form::textarea('message', null, ['class' => 'form-control counted', 'rows' => '6', 'placeholder' => "And finally, don't forget to enter a message"]) }}

                                        @if($errors->has('message'))
                                            <span class="error-msg">{{ $errors->first('message') }}</span>
                                        @endif
                                        <h6 class="pull-right" id="counter">500 characters remaining</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="field-row form-group">
                                        {{ Form::label('recaptcha', 'Solve the recaptcha below *') }}
                                        {{ Form::captcha() }}

                                        @if($errors->has('g-recaptcha-response'))
                                            <span class="error-msg">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="field-row form-group">
                                    <div class="buttons-holder">
                                        {{ Form::submit('Send Message', ['class' => 'le-button medium']) }}
                                    </div>
                                </div>

                            </div>

                        </fieldset>
                        {{ Form::close() }}

                    </section>
                    <!-- /.leave-a-message -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <section class="our-store section inner-left-xs">
                        <h2 class="bordered">Our Store's location</h2>
                        <address>
                            Karen Business Park <br>
                            Karen, Nairobi <br>
                            P.O.BOX 32010-0200, Nairobi
                        </address>
                        <h3>Business Hours</h3>
                        <ul class="list-unstyled operation-hours">
                            <li class="clearfix">
                                <span class="day">Monday to Friday</span>
                                <span class="pull-right hours">8AM - 6 PM</span>
                            </li>

                        </ul>

                        <h3>More Information</h3>

                        <p>Need more Information about us? We are happy to provide it to you.
                            Just click <a href="{{ route('about') }}">here:</a></p>
                    </section>
                    <!-- /.our-store -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </main>
@stop

@section('scripts')

    @parent

    {{ HTML::script("http://maps.googleapis.com/maps/api/js") }}
    {{ HTML::script('assets/js/vendor/formvalidation/formValidation.min.js') }}
    {{ HTML::script('_bootstrap.min.js') }}
@stop