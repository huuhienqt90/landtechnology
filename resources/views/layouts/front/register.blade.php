@extends('layouts.front.master')

@section('meta')
    <title>Register - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Register',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content')
<div class="breadcrumb full-width text-center">
    <div class="background">
        <div class="pattern">
            <div class="container">
                <div class="clearfix">
                    <h1 id="title-page">Register Account</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('front.index') }}">Home</a></li>
                        <li class="active">Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content full-width inner-page">
    <div class="background">
        <div class="pattern">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-9 col-sm-offset-2 center-column">

                                <p>If you already have an account with us, please login at the <a href="{{ route('front.user.login') }}">login page</a>.</p>
                                {!! Form::open(['route' => 'front.user.store', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                    <fieldset>
                                        <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                                            {{ Form::label('input-firstname', 'First Name', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('first_name', old('first_name'), ['placeholder' => 'First Name', 'class' => 'form-control', 'id' => 'input-firstname']) }}
                                                {{ Form::label(null, $errors->has('first_name')? $errors->first('first_name') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                                            {{ Form::label('input-LastName', 'Last Name', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('last_name', old('last_name'), ['placeholder' => 'Last Name', 'class' => 'form-control', 'id' => 'input-lastname']) }}
                                                {{ Form::label(null, $errors->has('last_name')? $errors->first('last_name') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                                            {{ Form::label('input-email', 'E-Mail', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('email', old('email'), ['placeholder' => 'E-Mail', 'class' => 'form-control', 'id' => 'input-email']) }}
                                                {{ Form::label(null, $errors->has('email')? $errors->first('email') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div><!-- 
                                        <div class="form-group">
                                            {{ Form::label('input-telephone', 'Mobile Number', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('mobilenumber', old('mobilenumber'), ['placeholder' => 'Mobile Number', 'class' => 'form-control', 'id' => 'input-telephone', 'required' => 'required', 'pattern' => '[\+]\d{8,20}']) }}
                                            </div>
                                        </div> -->
                                    </fieldset>

                                    <fieldset>
                                        <legend>Your Address</legend>
                                        <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                                            {{ Form::label('input-address-1', 'Address 1', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('address1', old('address1'), ['placeholder' => 'Address 1', 'class' => 'form-control', 'id' => 'input-address-1']) }}
                                                {{ Form::label(null, $errors->has('address1')? $errors->first('address1') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('input-address-2', 'Address 2', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('address2', old('address2'), ['placeholder' => 'Address 2', 'class' => 'form-control', 'id' => 'input-address-2']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('country')? 'has-error' : '' }}">
                                            {{ Form::label('country', 'Country', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::select('country', ['L' => 'Large', 'S' => 'Small'], old('country'), ['placeholder' => 'Select Country', 'class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('country')? $errors->first('country') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('region')? 'has-error' : '' }}">
                                            {{ Form::label('region', 'Region', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::select('region', ['L' => 'Large', 'S' => 'Small'], old('region'), ['placeholder' => 'Select Region', 'class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('region')? $errors->first('region') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('postalcode')? 'has-error' : '' }}">
                                            {{ Form::label('input-postcode', 'Post Code', ['class' => 'col-sm-2 control-label']) }}
                                            <div class="col-sm-10">
                                                {{ Form::text('postalcode', old('postalcode'), ['placeholder' => 'Post Code', 'class' => 'form-control', 'id' => 'input-postalcode']) }}
                                                {{ Form::label(null, $errors->has('postalcode')? $errors->first('postalcode') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                    </fieldset>

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
                                    <!-- <fieldset>
                                        <legend>Newsletter</legend>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Subscribe</label>
                                            <div class="col-sm-10">
                                                <label class="radio-inline">
                                                <input type="radio" name="newsletter" value="1" />
                                                Yes</label>
                                                <label class="radio-inline">
                                                <input type="radio" name="newsletter" value="0" checked="checked" />
                                                No</label>
                                            </div>
                                        </div>
                                    </fieldset> -->
                                    <div class="text-center mg-top-20">
                                        I have read and agree to the <a href="index11ee.html?route=information/information/agree&amp;information_id=3" class="agree"><b>Privacy Policy</b></a>
                                        {{ Form::checkbox('agree', '1', false,['required' => 'required']) }}&nbsp;
                                        {{ Form::submit('Continue', ['class' => 'btn btn-primary']) }}
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
@stop