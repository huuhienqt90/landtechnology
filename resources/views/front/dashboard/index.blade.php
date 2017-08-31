@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Dashboard - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Login',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content-dashboard')
<h3>Content</h3>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Dashboard</h3>
    </div>
    <div class="panel-body">
        <p>Admin Dashboard Accordion List Group Menu</p>
        <div class="alert alert-success"><h3>Yes! It's compatible with BS 3.0.3, 3.1 & 3.2 </h3></div>
    </div>
</div>
@stop