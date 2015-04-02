@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>PC World&nbsp&middot&nbspContacts</title>
@stop

@section('slider')

@stop

@section('breadcrumb')

@show

@section('content')
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="row inner-bottom-sm contact-page">
                <h3>Our location</h3>

                <div class="col-md-12 m-b-40" id="map">

                </div>
                <div class="col-md-5" id="cont">
                    {!! Form::open(['url' => route('contact.post'), 'id' => 'contact-form']) !!}
                    <fieldset>
                        <legend>Get in touch with us. We would love to hear from you</legend>
                        <h6>Fields marked with * are required</h6>

                        <div id="contactFormResult"></div>
                        <div class="form-group">
                            {!! Form::label('email', 'Your Email *') !!}

                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email address', 'required']) !!}
                            @if($errors->has('email'))
                                <span class="error-msg">{!! $errors->first('email') !!}</span>
                            @endif
                        </div>
                        <div class="form-group">

                            {!! Form::label('subject', 'Subject') !!}

                            {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter a message subject']) !!}
                            @if($errors->has('subject'))
                                <span class="error-msg">{!! $errors->first('subject') !!}</span>
                            @endif

                        </div>
                        <div class="form-group">
                            {!! Form::label('message', 'Your message *') !!}

                            {!! Form::textarea('message', null, ['class' => 'form-control counted', 'rows' => '6', 'required']) !!}

                            @if($errors->has('message'))
                                <span class="error-msg">{!! $errors->first('message') !!}</span>
                            @endif
                            <h6 class="pull-right" id="counter">500 characters remaining</h6>
                        </div>

                        <div class="form-group m-t-20 m-b-10">
                            {!! Form::label('recaptcha', 'Solve the recaptcha below *') !!}
                            &nbsp;<span>{!! link_to('https://www.google.com/recaptcha/intro/index.html', 'what is this?', ['target' => '_blank']) !!}</span>
                            {!! Recaptcha::render() !!}

                            @if($errors->has('g-recaptcha-response'))
                                <span class="error-msg">{!! $errors->first('g-recaptcha-response') !!}</span>
                            @endif
                        </div>

                        <hr/>
                        <button type="submit" class="btn btn-primary" id="sendMsg" data-loading-text="please wait...">
                            send message
                        </button>

                    </fieldset>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@stop

@section('scripts')
    @parent
    {!! HTML::script("//maps.googleapis.com/maps/api/js") !!}
@stop