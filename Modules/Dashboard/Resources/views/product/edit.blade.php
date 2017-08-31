@extends('dashboard::layouts.master')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/select2/dist/css/select2.min.css') }}">
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update product</h3>
                    </div>
                    {!! Form::model($product, ['route' => ['dashboard.product.update', $product->id], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.select', ['field' => 'status', 'label' => 'Status', 'options' => ['active' => 'Active', 'pending' => 'Pending', 'need-confirm' => 'Need confirm']])
                        @include('dashboard::partials.input', ['field' => 'name', 'label' => 'Name', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field'=>'slug', 'label' => 'Slug', 'options' => ['class'=>'form-control', 'readonly' => 'true']])
                        @include('dashboard::partials.input', ['field' => 'original_price', 'label' => 'Price', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'discount', 'label' => 'Discount', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'price_after_discount', 'label' => 'Price after discount', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'sale_price', 'label' => 'Sale Price', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'display_price', 'label' => 'Display Price', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.file', ['field' => 'feature_image', 'label' => 'Feature Image'])
                        @include('dashboard::partials.text-editor', ['field' => 'description', 'label' => 'Description', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.select', ['field' => 'product_brand', 'label' => 'Product Brand', 'options' => $brandArr])
                        @include('dashboard::partials.select-multiple', ['field' => 'category', 'placeholder' => 'Please select category', 'label' => 'Category', 'options' => $cateArr])
                        @include('dashboard::partials.select', ['field' => 'seller_id', 'label' => 'Seller', 'options' => $sellerArr])
                        @include('dashboard::partials.input', ['field' => 'key_words', 'label' => 'Key Words', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.select', ['field' => 'sell_type_id', 'label' => 'Sell Type', 'options' => $sellTypeArr])
                        @include('dashboard::partials.input', ['field' => 'weight', 'label' => 'Weight', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'location', 'label' => 'Location', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'stock', 'label' => 'Stock', 'options' => ['class'=>'form-control']])
                        @include('dashboard::partials.input', ['field' => 'sold_units', 'label' => 'Sold units', 'options' => ['class'=>'form-control']])
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
    <!-- /.content -->
    <script src="{{ asset('themes/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.select2').select2();
        });
    </script>
@stop
