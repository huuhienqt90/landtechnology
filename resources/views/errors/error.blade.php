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
                    <span class="text-uppercase">component not found</span>
                    <h1 class="text-uppercase">Nothing to see here!</h1>
                    <p>
                        The page are looking for has been moved or doesn’t exist anymore, if you like you can return to our homepage. If the problem persists, please send us an email to
                        <a href="#" title="title erentheme">Erentheme@gmail.com</a>
                    </p>
                    <form>
                        <input class="sb-search-input" placeholder="Enter text type..." type="search" value="" name="search" id="search">
                        <input class="sb-search-submit" type="submit" value="SEARCH">
                    </form>
                </div> <!-- .text-content-error -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- .content-error -->

@stop
