@extends('dashboard::layouts.master')
<link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/select2/dist/css/select2.min.css') }}">
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create coupon</h3>
                    </div>
                    {!! Form::model($coupon, ['route' => ['dashboard.coupon.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.input', ['field' => 'code', 'label' => 'Code coupon', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.text-editor', ['field' => 'description', 'label' => 'Description', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.select', ['field' => 'type_discount', 'label' => 'Discount type', 'options' => ['percent' => 'Percentage discount', 'fixed_cart' => 'Fixed cart discount', 'fixed_product' => 'Fixed product discount']])
                        @include('dashboard::partials.input', ['field' => 'cost', 'label' => 'Cost', 'options' => ['class' => 'form-control', 'placeholder' => '0']])
                        @include('dashboard::partials.input', ['field' => 'minimum', 'label' => 'Minimum', 'options' => ['class' => 'form-control', 'placeholder' => 'No minimum']])
                        @include('dashboard::partials.input', ['field' => 'maximum', 'label' => 'Maximum', 'options' => ['class' => 'form-control', 'placeholder' => 'No maximum']])
                        @include('dashboard::partials.input', ['field' => 'limit_usage', 'label' => 'Usage limit per coupon', 'options' => ['class' => 'form-control', 'placeholder' => 'Unlimit usage']])
                        @include('dashboard::partials.select-multiple', ['field' => 'products', 'placeholder' => 'Search for a product...', 'label' => 'Products', 'options' => []])
                        @include('dashboard::partials.select-multiple', ['field' => 'categories', 'placeholder' => 'Please select category', 'label' => 'Categories', 'options' => $categories])
                        @include('dashboard::partials.input', ['field' => 'start_date', 'label' => 'Start date', 'options' => ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'id' => 'start_date']])
                        @include('dashboard::partials.input', ['field' => 'expiry_date', 'label' => 'Coupon expiry date', 'options' => ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'id' => 'expiry_date']])
                        <div class="buttons">
                            <input type="submit" class="btn btn-primary" value="Save changes" />
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('themes/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('select[name="products[]"]').select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("dashboard.getproduct") }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        console.log(data);
                        return {
                          results: data
                        };
                    },
                    cache: true
                }
            });
            $('select[name="categories[]"]').select2();
            //Date picker
            $('#expiry_date').datepicker({
              autoclose: true
            });
            $('#start_date').datepicker({
              autoclose: true
            });
        });
    </script>
    <!-- /.content -->
@stop