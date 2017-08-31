@extends('layouts.front.master')

@section('meta')
    @include('social::meta-article', [
        'title'         => 'Home',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content')
<!--  prashant kumar   --> 
<div class="breadcrumb full-width">
    <div class="background">
        <div class="pattern">
            <div class="container">
                <div class="clearfix">
                    <h1 id="title-page">Account Login</h1>
                    <ul>
                        <li><a href="{{Request::root()}}">Home</a></li>
                        <li><a href="{{Request::root()}}/login">Login</a></li>
                    </ul>
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
                            <div class="col-sm-9 center-column">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="well">
                                            <h2>New Customer</h2>
                                            <p><strong>Register Account</strong></p>
                                            <p style="padding-bottom: 10px">By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                                            <a href="register" class="btn btn-primary">Continue</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="well">
                                            <h2>Returning Customer</h2>
                                            <p><strong>I am a returning customer</strong></p>
                                            <form action="login" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                                                <div class="form-group">
                                                    <label class="control-label" for="input-email">E-Mail Address</label>
                                                    <input type="email" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" required/>
                                                </div>
                                                <div class="form-group" style="padding-bottom: 10px">
                                                    <label class="control-label" for="input-password">Password</label>
                                                    <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" required/>
                                                    <a href="{{Request::root()}}/forgot-password">Forgotten Password</a>
                                                </div>
                                                <input type="submit" value="Login" class="btn btn-primary" />
                                                <input type="hidden" name="redirect" value="indexe223.html?route=account/wishlist" />
                                         </form>
                                        </div>
                                    </div>
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