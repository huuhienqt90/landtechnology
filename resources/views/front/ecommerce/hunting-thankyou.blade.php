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
                    {{ Breadcrumbs::render('home') }}
                </div> <!-- .menu-content-check-out -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #content-check-out -->

    <!-- START #show-list-infomation -->
    <section id="show-list-infomation">
        <div class="container">
            <h2>Thank for your hunting product. We will process your order with in 24 hours.</h2>
        </div> <!-- .container -->
    </section> <!-- #show-list-infomation -->
@stop
