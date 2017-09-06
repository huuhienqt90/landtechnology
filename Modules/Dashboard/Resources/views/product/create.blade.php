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
                        <h3 class="box-title">Create category</h3>
                    </div>
                    {!! Form::model($product, ['route' => ['dashboard.product.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
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
                        <div class="form-group {{ $errors->has('attribute') ? ' has-error' : ''}}">
                           <label for="{{ 'attribute' }}" class="col-sm-2 control-label">Attributes</label>
                           <div class="col-sm-4">
                                {!! Form::select('attribute'.'[]', $attrArr, Form::getValueAttribute('attribute'), ['class' => 'form-control select2', 'multiple' => true, 'data-placeholder' => 'Please select attribute', 'id' => 'attribute']) !!}
                                @include('dashboard::partials.error', ['field' => 'attribute'])
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-primary" id="addAttr">+</a>
                            </div>
                        </div>
                        <div id="attributes"></div>
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
    <script src="{{ asset('themes/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.select2').select2();

            $("#addAttr").click(function(e) {
                e.preventDefault();
                var id = $('#attribute').val();
                $.ajax({
                    url: "{{ route('dashboard.getattr') }}",
                    type: "GET",
                    data: {id: id},
                    success: function(result) {
                        console.log(result);
                    },
                    error: function(data){
                        console.log(data);
                    },
                });
            });
        });
    </script>
@stop
