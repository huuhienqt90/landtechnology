@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create commission</h3>
                    </div>
                    {!! Form::model($commission, ['route' => ['dashboard.commission.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        @include('dashboard::partials.select', ['field' => 'category', 'label' => 'Category', 'options' => $parentCateArr])
                        @include('dashboard::partials.select', ['field' => 'category_id', 'label' => 'Subcategory', 'options' => $cateArr])
                        @include('dashboard::partials.select', ['field' => 'type', 'label' => 'Type', 'options' => setTypeCommission()])
                        @include('dashboard::partials.input', ['field' => 'cost', 'label' => 'Cost', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.input', ['field' => 'maximum', 'label' => 'Maximum', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.select', ['field' => 'product_type', 'label' => 'Product Type', 'options' => setProductTypeCommission()])
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
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('select[name="category"]').on('change', function(){
                var optionSelected = $("option:selected", this);
                var id = this.value;
                $('select[name="category_id"]').html('<option value="">Select a subcategory</option>');
                $.ajax({
                    url: "{{ route('dashboard.getsubcategory') }}",
                    type: "GET",
                    data: {id:id},
                    success: function(result){
                        $.each(result, function(k,v){
                            $('select[name="category_id"]').append('<option value="'+v.id+'">'+v.name+'</option>');
                        });
                    }
                });
            });
        });
    </script>
@stop