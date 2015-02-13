@extends('layouts.frontend.master')

@section('head')
    @parent
    <title>Terms and conditions</title>
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

    <div class="container">
        <section class="section section-page-title">
            <div class="page-header">
                <h2 class="page-title">{{{ ucwords(strtolower(str_replace('_', ' ', $terms->name))) }}}</h2>

                <p class="page-subtitle">This Agreement was last modified on {{{ $terms->updated_at }}}.</p>
            </div>
        </section>

        {{ $terms->extended_value }}

        <section class="section intellectual-property">
            <h2>Contact Us</h2>

            <p>If you have any questions about this Agreement, please contact us filling this <a
                        href="{{ route('contact') }}#msg-link">contact form</a></p>
        </section>

    </div>


@stop