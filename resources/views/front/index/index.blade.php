@section('meta')
    @include('social::meta-article', [
        'title'         => 'Home',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@extends('layouts.front.master')
@section('content')
 Hello Girl
@stop