@extends('layouts.front.master')

@section('meta')
    <title>List Product</title>
    @include('social::meta-article', [
        'title'         => 'List Products',
        'description'   => 'List Products',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')

    <h1>Page not found!</h1>

@stop