@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create user</h3>
                    </div>
                    {!! Form::model($user, ['route' => ['dashboard.user.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.input', ['field' => 'username', 'label' => 'Username', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'email', 'label' => 'Email', 'options' => ['class'=>'form-control']])
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="{{ 'password' }}" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-4">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                @include('dashboard::partials.error', ['field' => 'password'])
                            </div>
                        </div>
                        @include('dashboard::partials.input', ['field' => 'first_name', 'label' => 'First name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'last_name', 'label' => 'Last name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'address1', 'label' => 'Address 1', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'address2', 'label' => 'Address 2', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'country', 'label' => 'Country', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'postal_code', 'label' => 'Postal code', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'region', 'label' => 'Region', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.file-bootstrap', ['field' => 'avatar', 'label' => 'Avatar', 'url' => '#'])
                        <div class="buttons">
                            <input type="submit" class="btn btn-primary" value="Save changes" />
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
