@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Attribute Group</h3>
                    </div>
                    {!! Form::model($attributeGroup, ['route' => ['dashboard.attribute-group.update', $attributeGroup->id], 'class' => 'form-horizontal', 'files' => true, 'method' => 'put']) !!}
                    <div class="box-body">
                        @include('dashboard::partials.select', ['field' => 'seller_id', 'label' => 'Seller', 'options' => $sellerArr])
                        @include('dashboard::partials.input', ['field'=>'name', 'label' => 'Name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.select', ['field' => 'parent', 'label' => 'Parent', 'options' => $attributesGroupArr])
                        @include('dashboard::partials.select', ['field' => 'type', 'label' => 'Type', 'options' => $listTypes])
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
