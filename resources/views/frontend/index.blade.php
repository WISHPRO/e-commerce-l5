@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Welcome to PC-World, Online shopping for Computers and accessories</title>
@stop

@section('breadcrumbs')

@stop
@section('content')
    <div class="container" style="margin-bottom: 84px">
        <section class="section wow fadeInUp animated">


        </section>
    </div>
@stop

@section('scripts')

    @parent
    {{--<script>--}}
    {{--jQuery( document ).ready( function( $ ) {--}}

    {{--$( "#addToCart" ).submit(function( event ) {--}}
    {{--event.preventDefault();--}}
    {{--var $form = $( this ),--}}
    {{--data = $form.serialize(),--}}
    {{--url = $form.attr( "action" );--}}

    {{--var posting = $.post( url, { formData: data } );--}}
    {{--console.log(posting);--}}
    {{--posting.done(function( data ) {--}}
    {{--if(data.fail) {--}}
    {{--alert();--}}
    {{--}--}}
    {{--if(data.success) {--}}

    {{--var successContent = "success";--}}
    {{--//$('#successMessage').html(successContent);--}}
    {{--Console.log(successContent);--}}
    {{--} //success--}}
    {{--}); //done--}}
    {{--});--}}

    {{--} );--}}
    {{--</script>--}}
@stop