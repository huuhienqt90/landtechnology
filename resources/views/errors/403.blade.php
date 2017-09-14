@extends('layouts.front.master')

@section('meta')
    <title>Permission</title>
    @include('social::meta-article', [
        'title'         => 'Permission',
        'description'   => 'Permission',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')

    <!-- START #content-error -->
    <section id="content-error">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 img-error-404">
                    <img src="{{ asset('assets/images/error.png') }}" class="img-responsive" alt="images error 404">
                </div> <!-- .img-error-404 -->
                <div class="col-sm-6 col-sm-offset-3 text-content-error">
                    <span class="text-uppercase">FORBIDDEN</span>
                    <h1 class="text-uppercase">You can not access to this page</h1>
                    <p>
                        You can not access to this page, if you like you can return to our <a href="">homepage</a>.
                    </p>
                </div> <!-- .text-content-error -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- .content-error -->

@stop
