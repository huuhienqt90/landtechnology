@extends('layouts.front.master')

@section('meta')
    <title>Checkout Success - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Checkout Success - Land Technology',
        'description'   => 'Land Technology',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')
    <section id="content-check-out">
        <div class="container">
            <div class="row">
                <div class="col-md-12 menu-content-check-out">
                    {{ Breadcrumbs::render('checkout') }}
                </div> <!-- .menu-content-check-out -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #content-check-out -->

    <!-- START #show-list-infomation -->
    <section id="show-list-infomation">
        <div class="container">
            @if (Session::has('alert-success'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="custom-alerts alert {{ Session::has('alert-success') ? 'alert-success' : 'alert-danger' }} fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! Session::get('alert-success') !!}
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($data) && $data['ACK'] == 'Success')
            <h2>Thank for your order. We will process your order with in 24 hours.</h2>
            @endif
            @if(isset($data) && $data['ACK'] == 'Failure')
            <h2>Error process, please check information again!</h2>
            @endif
            @if( isset($charge) )
            <h2>Thank for your order. We will process your order with in 24 hours.</h2>
            @endif
        </div> <!-- .container -->
    </section> <!-- #show-list-infomation -->
@stop
