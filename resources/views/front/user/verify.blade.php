@extends('layouts.front.master')

@section('meta')
    <title>Login - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Login',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <h1>Please enter code from your email to input</h1>
            {!! Form::open(['route' => ['front.user.doVerify', $id], 'method' => 'post']) !!}
                <div class="col-md-5">
                    {{ Form::text('code', old('code'),['class' => 'form-control', 'placeholder' => 'Enter code']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::submit('Verify', ['class' => 'btn btn-primary']) }}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop