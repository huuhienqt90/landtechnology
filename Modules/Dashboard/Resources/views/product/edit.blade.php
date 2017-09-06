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
                    {!! Form::model($product, ['route' => ['dashboard.product.update', $product->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
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
                        @include('dashboard::partials.file-multiple', ['field' => 'product_images', 'label' => 'Product Images'])
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
                        <div class="form-group">
                           <label for="{{ 'attribute' }}" class="col-sm-2 control-label">Attributes</label>
                           <div class="col-sm-4">
                                <select class="form-control select2" id="attribute" name="attribute[]" multiple data-placeholder="Please select attributes">
                                    @foreach($attrArr as $attr)
                                    <option value="{{ $attr->id }}" {{ selected(in_array($attr->id, array_keys($product->attribute)), true) }}>{{ $attr->name }}</option>
                                    @endforeach
                                </select>
                                @include('dashboard::partials.error', ['field' => 'attribute'])
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-primary" id="addAttr">+</a>
                            </div>
                        </div>
                        <div id="attributes">
                            @foreach($product->attribute as $id=>$name)
                                <div class="form-group">
                                   <label for="{{ 'attribute' }}" class="col-sm-2 control-label">{{ $name }}</label>
                                   <div class="col-sm-4">
                                        <select class="form-control select2" id="{{ $name . $id }}" name="prattr[{{$id}}][]" multiple data-placeholder="Please select attributes">
                                            @if( \App\Models\Attribute::getValuesById($id) != null)
                                                @foreach(\App\Models\Attribute::getValuesById($id) as $attr)
                                                <option value="{{ $attr }}" {{ selected(in_array($attr, array_values($attributesArr)), true) }}>{{ $attr }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('dashboard::partials.error', ['field' => 'attribute'])
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-warning" id="btnAddAttr{{ $id }}">+</a>
                                    </div>
                                    <script type="text/javascript">
                                        jQuery(document).ready(function($){
                                            $("#btnAddAttr{{ $id }}").click(function(){
                                                $("#textAttr").html('');
                                                $("#textAttr").append('<input type="text" class="form-control" placeholder="Enter value of attribute" id="otherVal{{$id}}"/>');
                                                $('#modal-default').modal('show');
                                                $("#saveAttr").on('click',function(e){
                                                    e.preventDefault();
                                                    $('#modal-default').modal('hide');
                                                    if( $('#otherVal{{$id}}').length > 0 ){
                                                        var val = $('#otherVal{{$id}}').val();
                                                        $('select[name="prattr[{{$id}}][]"]').append('<option value="'+val+'">'+val+'</option>');
                                                    }
                                                    $.ajax({
                                                        url: "{{ route('dashboard.addfast') }}",
                                                        type: "POST",
                                                        data: {id: {{$id}},val: val},
                                                        success: function(rs) {
                                                            console.log(rs);
                                                        }
                                                    });
                                                });
                                            })
                                        });
                                    </script>
                                </div>
                            @endforeach
                        </div>
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
            $("#addAttr").click(function(e) {
                e.preventDefault();
                var id = $('#attribute').val();
                $.ajax({
                    url: "{{ route('dashboard.getattr') }}",
                    type: "GET",
                    data: {id: id},
                    success: function(results) {
                        $.each(results, function(){
                            var arOptions = this.options.split(",");
                            var htmlOptions;
                            $.each(arOptions, function(k,v){
                                htmlOptions += '<option value="'+v+'">'+v+'</option>';
                            });
                            if( $("#"+this.name + this.id).length <= 0 ){
                                $("#attributes").append('<div class="form-group"><label for="'+this.name+'" class="col-sm-2 control-label">'+this.name+'</label><div class="col-sm-4"><select class="form-control select2" multiple data-placeholder="Please select '+this.name+'" id="'+this.name+this.id+'" name="prattr['+this.id+'][]">'+htmlOptions+'</select></div><div class="col-sm-2"><a class="btn btn-warning" id="btnAddAttr'+this.id+'">+</a></div>');
                            }
                            $('.select2').select2();
                            var idAtt = this.id;
                            $('#btnAddAttr'+idAtt+'').on('click',function(e){
                                e.preventDefault();
                                $("#textAttr").html('');
                                $("#textAttr").append('<input type="text" class="form-control" placeholder="Enter value of attribute" id="otherVal'+idAtt+'"/>');
                                $('#modal-default').modal('show'); 
                            });

                            $("#saveAttr").on('click',function(e){
                                e.preventDefault();
                                $('#modal-default').modal('hide');
                                if( $('#otherVal'+idAtt).length > 0 ){
                                    var val = $('#otherVal'+idAtt).val();
                                    $('select[name="prattr['+idAtt+'][]"]').append('<option value="'+val+'">'+val+'</option>');
                                }
                                $.ajax({
                                    url: "{{ route('dashboard.addfast') }}",
                                    type: "POST",
                                    data: {id: idAtt,val: val},
                                    success: function(rs) {
                                        console.log(rs);
                                    }
                                });
                            });
                        });
                    },
                    error: function(data){
                        console.log(data);
                    },
                });
            });

            $('.select2').select2();
        });
    </script>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add values for attribute</h4>
                </div>
                <div class="modal-body">
                    <div id="textAttr"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a id="saveAttr" class="btn btn-primary">Save changes</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop
