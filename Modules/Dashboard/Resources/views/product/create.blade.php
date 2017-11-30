@extends('dashboard::layouts.master')
    <!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/select2/dist/css/select2.min.css') }}">
@section('content')
<script>
    var count = 1;
    var productAttrs = [];
</script>
    {!! Form::model($product, ['route' => ['dashboard.product.store'], 'class' => 'form', 'files' => true]) !!}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-lg-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create product</h3>
                    </div>
                    <div class="box-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::text('name', old('name'), ['class' => 'form-control input-lg', 'placeholder' => 'Product name']) !!}
                            @include('dashboard::partials.error', ['field' => 'name'])
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! old('description') !!}</textarea>
                            @include('dashboard::partials.error', ['field' => 'description'])
                        </div>
                        <div class="form-group {{ $errors->has('description_short') ? ' has-error' : '' }}">
                            <label for="description_short" class="control-label">Product short description</label>
                            <textarea class="textarea" id="description_short" name="description_short" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description_short') }}</textarea>
                            @include('dashboard::partials.error', ['field' => 'description_short'])
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="form-inline">
                            <label class="control-label">Product Data — </label>
                            {!! Form::select('product_type', ['simple' => 'Simple', 'booking' => 'Booking', 'variable' => 'Variable'], old('product_type'), ['class' => 'form-control product-type']) !!}
                        </div>
                    </div>
                    <div class="box-body">
                        <ul class="nav nav-tabs list-product-type-navs" role="tablist">
                            <li role="presentation" class="active show-if-simple"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
                            <li role="presentation" class="show-if-simple show-if-variable"><a href="#inventory" aria-controls="inventory" role="tab" data-toggle="tab">Inventory</a></li>
                            <li role="presentation" class="show-if-simple show-if-variable"><a href="#shipping" aria-controls="shipping" role="tab" data-toggle="tab">Shipping</a></li>
                            <li role="presentation" class="show-if-booking"><a href="#booking" aria-controls="booking" role="tab" data-toggle="tab">Booking</a></li>
                            <li role="presentation" class="show-if-simple show-if-variable"><a href="#attribute" aria-controls="attribute" role="tab" data-toggle="tab">Attributes</a></li>
                            <li role="presentation" class="show-if-variable"><a href="#variation" aria-controls="variation" role="tab" data-toggle="tab">Variations</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content list-product-type-contents">
                            <div role="tabpanel" class="tab-pane active" id="general">
                                @include('dashboard::product.tabs.general')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="inventory">
                                @include('dashboard::product.tabs.inventory')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="shipping">
                                @include('dashboard::product.tabs.shipping')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="attribute">
                                @include('dashboard::product.tabs.attribute')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="variation">
                                @include('dashboard::product.tabs.variation')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="booking">
                                @include('dashboard::product.tabs.booking')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Publish</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="control-label">Status</label>
                            {!! Form::select('status', setActiveProduct(), old('status'), ['class' => 'form-control']) !!}
                            @include('dashboard::partials.error', ['field' => 'status'])
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-success" value="Save" />
                        </div>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>
                    </div>
                    <div class="box-body">
                        @if( isset( $categories ) && $categories->count() )
                            <ul class="nav nav-pills nav-stacked">
                            @foreach($categories as $category)
                                <li><label><input type="checkbox" class="minimal" value="{{ $category->id }}" name="categories[]"> {{ $category->name }}</label>
                                @if( $category->getChildren()->count() )
                                    <ul class="sub-nav" style="list-style: none;">
                                    @foreach($category->getChildren() as $subCategory)
                                        <li><label><input type="checkbox" class="minimal" value="{{ $subCategory->id }}" name="categories[]"> {{ $subCategory->name }}</label></li>
                                    @endforeach
                                    </ul>
                                @endif
                                </li>
                            @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brands</h3>
                    </div>
                    <div class="box-body">
                        {{ Form::select('product_brand', $brandArr, old('product_brand'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sell Type</h3>
                    </div>
                    <div class="box-body">
                        {{ Form::select('sell_type', $sellTypeArr, old('sell_type'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tags</h3>
                    </div>
                    <div class="box-body">
                        {{ Form::select('tags[]', $arrTags, null, ['class' => 'form-control tags', 'multiple' => true]) }}
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product image</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('feature_image') ? ' has-error' : '' }}">
                            {!! Form::file('feature_image',['id'=> 'feature_image', 'class' => 'file', 'data-upload-url' => '#', 'name' => 'feature_image']) !!}
                            @include('dashboard::partials.error', ['field' => 'feature_image'])
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $("#feature_image").fileinput({
                        uploadUrl: '#',
                        uploadAsync: false,
                        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                        showUpload: false,
                    });
                </script>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product gallery</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('product_images') ? ' has-error' : '' }}">
                            {!! Form::file('product_images[]',['id'=> 'product_images', 'class' => 'file', 'multiple' => 'true', 'data-upload-url' => '#', 'name' => 'product_images[]']) !!}
                            @include('dashboard::partials.error', ['field' => 'product_images'])
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $("#product_images").fileinput({
                        uploadUrl: '#',
                        uploadAsync: false,
                        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                        showUpload: false,
                    });
                </script>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
    <!-- /.content -->
    <style type="text/css">
        .kv-file-upload{
            display: none;
        }
        .file-preview-image {
            width: 100% !important;
            height: auto !important;
        }
        .krajee-default.file-preview-frame {
            overflow: hidden;
        }
        .set-value {
            margin-top: 10px;
        }
    </style>
    <script src="{{ asset('themes/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            changeProductType();
            function changeProductType(){
                var productType = $('.product-type').val();
                $('.list-product-type-navs li').addClass('hidden');
                $('.show-if-' + productType).removeClass('hidden');
                $('.list-product-type-navs li').removeClass('active');
                $('.list-product-type-contents div').removeClass('active');
                $('.list-product-type-navs li:not(.hidden):first').addClass('active');
                var id = $('.list-product-type-navs li:not(.hidden):first').find('a').attr('href');
                $(id).addClass('active');
            }
            $('.product-type').change(function(){
                changeProductType();
                return false;
            });
            CKEDITOR.replace('description');
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"], input[type="radio"]').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
              radioClass   : 'iradio_minimal-blue'
            });
            $('.select2').select2();

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var dis = $(e.target);
                if( dis.attr('href') == '#variation' ){
                    $('#new-item .product-variation-item').each(function(){
                        var attr = '<label>Attributes </label>';
                        $.each(productAttrs, function(index, value){
                            if( typeof value != "undefined" && typeof value.name != "undefined" ){
                                attr += '<div class="form-group"><select class="form-control attr-item" name="variationNew['+count+'][attr]['+index+']">';
                                attr += '<option value="0">Any '+value.name+' ...</option>';
                                $.each(value.attrs, function(subIndex, subValue){
                                    attr += '<option value="'+subValue+'">'+subValue+'</option>';
                                });
                                attr += '</select></div>';
                            }
                        });
                        $(this).find('.form-inline').html(attr);
                    });
                }
            });

            $("#addEventAttr").on('click', function(e) {
                e.preventDefault();
                var attr = $("select[name=attributes]").val();
                if( attr !== null ) {
                    $.ajax({
                        url: "{{ route('dashboard.getattr') }}",
                        type: "GET",
                        data: {id: attr},
                        success: function(results) {
                            productAttrs[results.id] = {name: results.name, attrs: []};
                            var arOptions = results.options.split(",");
                            var htmlOptions;
                            $.each(arOptions, function(k,v){
                                htmlOptions += '<option value="'+v+'">'+v+'</option>';
                            });
                            if( !$("#attr"+results.id).length ){
                                $("#appendAttr").append('<div class="box-group" id="attr'+results.id+'"><div class="panel box box-default"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" data-parent="#attr'+results.id+'" href="#collapseOne'+results.id+'">'+results.name+'</a></h4><a href="javascript:void(0)" class="pull-right text-danger" id="rmAttr'+results.id+'">Remove</a></div><div id="collapseOne'+results.id+'" class="panel-collapse collapse in"><div class="box-body"><div class="col-md-4"><p>Name:</p><span>'+results.name+'</span></div><div class="col-md-8"><p>Values:</p><select class="form-control select2" multiple="multiple" name="arrAttributes['+results.id+'][]" id="arrAttributes'+results.id+'" data-placeholder="Select values..." style="width: 100%;">'+htmlOptions+'</select><div class="set-value"><a href="javascript:void(0)" class="btn btn-default" id="selectAll'+results.id+'">Select all</a><a href="javascript:void(0)" class="btn btn-default" id="selectNone'+results.id+'">Select none</a><a href="javascript:void(0)" class="btn btn-default pull-right" id="addNewAttr'+results.id+'">Add new</a></div></div></div></div></div></div>');
                            }
                            $("#selectAll"+results.id).on('click', function() {
                                $("#arrAttributes"+results.id+" option").prop('selected', true);
                                $("#arrAttributes"+results.id).trigger("change");
                            });
                            $("#selectNone"+results.id).on('click', function() {
                                $("#arrAttributes"+results.id+" option").prop('selected', false);
                                $("#arrAttributes"+results.id).trigger("change");
                            });
                            $("#rmAttr"+results.id).on('click', function() {
                                productAttrs.splice(results.id, 1);
                                $("#attr"+results.id).remove();
                            });
                            $("#arrAttributes"+results.id).on('change', function(){
                                productAttrs[results.id].attrs = $(this).val();
                            });
                            $('#addNewAttr'+results.id).on('click',function(e){
                                e.preventDefault();
                                $("#textAttr").html('');
                                $("#textAttr").append('<input type="text" class="form-control" placeholder="Enter value of attribute" id="otherVal'+results.id+'"/>');
                                $('#modal-default').modal('show');
                            });

                            $("#saveAttr").on('click',function(e){
                                e.preventDefault();
                                $('#modal-default').modal('hide');
                                if( $('#otherVal'+results.id).length > 0 ){
                                    var val = $('#otherVal'+results.id).val();
                                    $('select[name="arrAttributes['+results.id+'][]"]').append('<option value="'+val+'" selected="selected">'+val+'</option>');
                                    $("#arrAttributes"+results.id).trigger("change");
                                }
                                $.ajax({
                                    url: "{{ route('dashboard.addfast') }}",
                                    type: "POST",
                                    data: {id: results.id,val: val},
                                    success: function(rs) {
                                        console.log(rs);
                                    }
                                });
                            });
                            $('.select2').select2();
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }
            });
            $('#add-new-variation').click(function(){
                if( productAttrs.length <= 0 ){
                    alert('Please add some product attributes first');
                }else{
                    var html = $('#clone > div').clone().html();
                    var text = html.replace(new RegExp('!#name#!', 'g'), count);
                    var attr = '';
                    $.each(productAttrs, function(index, value){
                        if( typeof value != "undefined" && typeof value.name != "undefined" ){
                            attr += '<div class="form-group"><select class="form-control attr-item" name="variationNew['+count+'][attr]['+index+']">';
                            attr += '<option value="0">Any '+value.name+' ...</option>';
                            $.each(value.attrs, function(subIndex, subValue){
                                attr += '<option value="'+subValue+'">'+subValue+'</option>';
                            });
                            attr += '</select></div>';
                        }
                    });
                    text = text.replace(new RegExp('!#attrs#!', 'g'), attr);
                    $('#new-item').append(text);
                    count++;
                }
                return false;
            });
            $('#new-item').on('click', '.remove-product-variation-item', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $('#product-variation-item-'+id).remove();
                return false;
            });

            function readURL(input) {
                console.log(input);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(input).prev('.variation-image-prev').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#new-item').on('change', '.variation_image', function(){
                readURL(this);
            });
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
