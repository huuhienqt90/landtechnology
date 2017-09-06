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
<!--  prashant kumar   -->
<div class="breadcrumb full-width text-center">
    <div class="background">
        <div class="pattern">
            <div class="container">
                <div class="clearfix">
                    <h1 id="title-page">Account Login</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('front.index') }}">Home</a></li>
                        <li class="active">Login</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT  ================================================== -->
<div class="main-content full-width inner-page">
    <div class="background">
        <div class="pattern">
            <div class="container">
                <div class="row">
                   <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="well">
                                    <h2>New Customer</h2>
                                    <p><strong>Register Account</strong></p>
                                    <a href="{{ route('front.social.login', 'facebook') }}" class="btn btn-block btn-social btn-facebook">
                                        <span class="fa fa-facebook"></span> Sign up with Facebook
                                    </a>
                                    <a href="{{ route('front.social.login', 'twitter') }}" class="btn btn-block btn-social btn-twitter">
                                        <span class="fa fa-twitter"></span> Sign up with Twitter
                                    </a>
                                    <a href="{{ route('front.social.login', 'linkedin') }}" class="btn btn-block btn-social btn-linkedin">
                                        <span class="fa fa-linkedin"></span> Sign up with Linkedin
                                    </a>
                                    <p style="padding-bottom: 10px; padding-top: 10px;">By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                                    <a href="{{ route('front.user.create') }}" class="btn-default btn-primary">Continue</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="well">
                                    <h2>Returning Customer</h2>
                                    <p><strong>I am a returning customer</strong></p>
                                    <a href="{{ route('front.social.login', 'facebook') }}" class="btn btn-block btn-social btn-facebook">
                                        <span class="fa fa-facebook"></span> Sign in with Facebook
                                    </a>
                                    <a href="{{ route('front.social.login', 'twitter') }}" class="btn btn-block btn-social btn-twitter">
                                        <span class="fa fa-twitter"></span> Sign in with Twitter
                                    </a>
                                    <a href="{{ route('front.social.login', 'linkedin') }}" class="btn btn-block btn-social btn-linkedin">
                                        <span class="fa fa-linkedin"></span> Sign in with Linkedin
                                    </a>
                                    @if(Session::has('messageError'))
                                        <div class="alert alert-danger" role="alert">
                                            <span>{{ Session::get('messageError') }}</span>
                                        </div>
                                    @endif
                                    {!! Form::open(['route' => 'front.user.doLogin', 'files' => true, 'method' => 'POST']) !!}
                                        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                                            {!! Form::label('email', 'E-mail or Username', ['class' => 'control-label']) !!}
                                            {!! Form::text('email', old('email'), ['class' => 'form-control','required' => 'required', 'id' => 'input-email','placeholder' => 'E-mail or Username']) !!}
                                            {{ Form::label(null, $errors->has('email')? $errors->first('email') : '', ['class' => 'help-block']) }}
                                        </div>
                                        <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}" style="padding-bottom: 10px">
                                            {!! Form::label('Password', 'Password', ['class' => 'control-label']) !!}
                                            {!! Form::password('password', ['class' => 'form-control','required' => 'required', 'id' => 'input-password','placeholder' => 'Password']) !!}
                                            {{ Form::label(null, $errors->has('password')? $errors->first('password') : '', ['class' => 'help-block']) }}
                                            {{ Form::hidden('confirmed', 1) }}
                                            <a href="#">Forgotten Password</a>
                                        </div>

                                        {!! Form::submit('Login!',['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
   </div>
</div>
@stop
