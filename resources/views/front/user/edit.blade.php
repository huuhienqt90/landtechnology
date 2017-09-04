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
        <h3 class="panel-title">Edit My Account</h3>
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
                                        {!! Form::open(['route' => 'front.user.update', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                            <fieldset>
                                                <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
                                                    {{ Form::label('input-firstname', 'First Name', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::text('first_name', Auth::user()->first_name, ['placeholder' => 'First Name', 'class' => 'form-control', 'id' => 'input-firstname']) }}
                                                        {{ Form::label(null, $errors->has('first_name')? $errors->first('first_name') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
                                                    {{ Form::label('input-LastName', 'Last Name', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::text('last_name', Auth::user()->last_name, ['placeholder' => 'Last Name', 'class' => 'form-control', 'id' => 'input-lastname']) }}
                                                        {{ Form::label(null, $errors->has('last_name')? $errors->first('last_name') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                                                    {{ Form::label('input-email', 'E-Mail', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::text('email', Auth::user()->email, ['placeholder' => 'E-Mail', 'class' => 'form-control', 'id' => 'input-email', 'readonly' => true]) }}
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
                                                <div class="form-group {{ $errors->has('address1')? 'has-error' : '' }}">
                                                    {{ Form::label('input-address-1', 'Address 1', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::text('address1', Auth::user()->address1, ['placeholder' => 'Address 1', 'class' => 'form-control', 'id' => 'input-address-1']) }}
                                                        {{ Form::label(null, $errors->has('address1')? $errors->first('address1') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('input-address-2', 'Address 2', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::text('address2', Auth::user()->address2, ['placeholder' => 'Address 2', 'class' => 'form-control', 'id' => 'input-address-2']) }}
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('country')? 'has-error' : '' }}">
                                                    {{ Form::label('country', 'Country', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::select('country', ['L' => 'Large', 'S' => 'Small'], Auth::user()->country, ['placeholder' => 'Select Country', 'class' => 'form-control']) }}
                                                        {{ Form::label(null, $errors->has('country')? $errors->first('country') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group {{ $errors->has('region')? 'has-error' : '' }}">
                                                    {{ Form::label('region', 'Region', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::select('region', ['L' => 'Large', 'S' => 'Small'], Auth::user()->region, ['placeholder' => 'Select Region', 'class' => 'form-control']) }}
                                                        {{ Form::label(null, $errors->has('region')? $errors->first('region') : '', ['class' => 'help-block']) }}
                                                    </div>
                                                </div> -->
                                                <div class="form-group {{ $errors->has('postal_code')? 'has-error' : '' }}">
                                                    {{ Form::label('input-postalcode', 'Post Code', ['class' => 'col-sm-2 control-label']) }}
                                                    <div class="col-sm-10">
                                                        {{ Form::text('postal_code', Auth::user()->postal_code, ['placeholder' => 'Post Code', 'class' => 'form-control', 'id' => 'input-postalcode']) }}
                                                        {{ Form::label(null, $errors->has('postal_code')? $errors->first('postal_code') : '', ['class' => 'help-block']) }}
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