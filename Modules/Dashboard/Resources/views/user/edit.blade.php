@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit user</h3>
                    </div>
                    {!! Form::model($user, ['route' => ['dashboard.user.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.input', ['field' => 'username', 'label' => 'Username', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'email', 'label' => 'Email', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'first_name', 'label' => 'First name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'last_name', 'label' => 'Last name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'address1', 'label' => 'Address 1', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'address2', 'label' => 'Address 2', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'country', 'label' => 'Country', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'postal_code', 'label' => 'Postal code', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'region', 'label' => 'Region', 'options' => ['class'=>'form-control']])
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
