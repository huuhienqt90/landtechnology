@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create brand</h3>
                    </div>
                    {!! Form::model($attributeGroup, ['route' => ['dashboard.attribute-group.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.select', ['field' => 'seller_id', 'label' => 'Seller', 'options' => $sellerArr])
                        @include('dashboard::partials.input', ['field'=>'name', 'label' => 'Name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.select', ['field' => 'parent', 'label' => 'Parent', 'options' => []])
                        @include('dashboard::partials.select', ['field' => 'type', 'label' => 'Type', 'options' => []])
                        @include('dashboard::partials.input', ['field' => 'value', 'label' => 'value', 'options' => ['class'=>'form-control']])
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
