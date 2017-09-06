@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit role</h3>
                    </div>
                    {!! Form::model($role, ['route' => ['dashboard.role.update', $role->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.input', ['field' => 'name', 'label' => 'Name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field'=>'slug', 'label' => 'Slug', 'options' => ['class'=>'form-control', 'readonly' => 'true']])
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
