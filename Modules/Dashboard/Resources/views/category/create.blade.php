@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create category</h3>
                    </div>
                    {!! Form::model($category, ['route' => ['dashboard.category.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.input', ['field' => 'name', 'label' => 'Name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field'=>'slug', 'label' => 'Slug', 'options' => ['class'=>'form-control', 'readonly' => 'true']])
                        @include('dashboard::partials.select', ['field' => 'parent_id', 'label' => 'Parent', 'options' => $cateArr])
                        @include('dashboard::partials.select', ['field' => 'status', 'label' => 'Status', 'options' => ['active' => 'Active', 'pending' => 'Pending', 'need-confirm' => 'Need confirm']])
                        @include('dashboard::partials.file', ['field' => 'image', 'label' => 'Image'])
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
