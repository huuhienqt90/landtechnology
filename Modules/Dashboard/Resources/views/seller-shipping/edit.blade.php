@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit seller shipping</h3>
                    </div>
                    {!! Form::model($sellerShipping, ['route' => ['dashboard.seller-shipping.update', $sellerShipping->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.input', ['field' => 'from_country', 'label' => 'From', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field'=>'to_country', 'label' => 'To', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field'=>'cost', 'label' => 'Cost', 'options' => ['class'=>'form-control']])
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
