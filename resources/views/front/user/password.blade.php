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
<h3 style="visibility: hidden;">Edit My Account</h3>
<!-- MAIN CONTENT -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Change Password</h3>
    </div>
    <div class="panel-body">
        <div class="main-content full-width inner-page">
            <div class="background">
                <div class="pattern">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-9 center-column">
                                        {!! Form::open(['route' => 'front.user.store', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                            <fieldset>
                                                <legend>Your Password</legend>
                                                <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                                                    {{ Form::label('input-password', 'Password', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'input-password']) }}
                                                        {{ Form::label(null, $errors->has('password')? $errors->first('password') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('confirm_password')? 'has-error' : '' }}">
                                                    {{ Form::label('input-confirm-password', 'Confirm Password', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'input-confirm-password']) }}
                                                        {{ Form::label(null, $errors->has('confirm_password')? $errors->first('confirm_password') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="text-center mg-top-20">
                                                {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                                            </div>
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
</div>
@stop