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
@if(Session::has('msgOk'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Well done!</strong> {{ Session::get('msgOk') }}
    </div>
@endif
@if(Session::has('msgEr'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> {{ Session::get('msgEr') }}
    </div>
@endif
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
                                        {!! Form::open(['route' => 'front.user.updatePass', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                            <fieldset>
                                                <div class="form-group {{ $errors->has('password_new')? 'has-error' : '' }}">
                                                    {{ Form::label('input-password-new', 'Password New', ['class' => 'col-sm-3 control-label']) }}
                                                    <div class="col-sm-9">
                                                        {{ Form::password('password_new', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'input-password-new']) }}
                                                        {{ Form::label(null, $errors->has('password_new')? $errors->first('password_new') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('confirm_password_new')? 'has-error' : '' }}">
                                                    {{ Form::label('input-confirm-password-new', 'Confirm New Password ', ['class' => 'col-sm-3 control-label']) }}
                                                    <div class="col-sm-9">
                                                        {{ Form::password('confirm_password_new', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'input-confirm-password-new']) }}
                                                        {{ Form::label(null, $errors->has('confirm_password_new')? $errors->first('confirm_password_new') : '', ['class' => 'help-block']) }}
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