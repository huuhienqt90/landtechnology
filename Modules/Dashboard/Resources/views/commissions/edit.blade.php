@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit commission</h3>
                    </div>
                    {!! Form::model($commission, ['route' => ['dashboard.commission.update', $commission->id], 'class' => 'form-horizontal', 'files' => true, 'method' => 'put']) !!}
                    <div class="box-body">
                        @include('dashboard::partials.select', ['field' => 'category_id', 'label' => 'Category', 'options' => $cateArr])
                        @include('dashboard::partials.input', ['field' => 'type', 'label' => 'Type', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.input', ['field' => 'cost', 'label' => 'Cost', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.input', ['field' => 'maximum', 'label' => 'Maximum', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.input', ['field' => 'product_type', 'label' => 'Product Type', 'options' => ['class' => 'form-control']])
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