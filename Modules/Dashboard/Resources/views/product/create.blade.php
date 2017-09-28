@extends('dashboard::layouts.master')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/select2/dist/css/select2.min.css') }}">
@section('content')
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
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::text('name', old('name'), ['class' => 'form-control input-lg', 'placeholder' => 'Product name']) !!}
                            @include('dashboard::partials.error', ['field' => 'name'])
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description</label>
                            <textarea class="textarea" id="description" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                            @include('dashboard::partials.error', ['field' => 'description'])
                        </div>
                        <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label for="short_description" class="control-label">Excerpt</label>
                            <textarea class="textarea" id="short_description" name="short_description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                            @include('dashboard::partials.error', ['field' => 'short_description'])
                        </div>
                        <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label for="short_description" class="control-label">Excerpt</label>

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
                                <li><label><input type="checkbox" class="minimal" name="categories[]"> {{ $category->name }}</label>
                                @if( $category->getChildren()->count() )
                                    <ul class="sub-nav" style="list-style: none;">
                                    @foreach($category->getChildren() as $subCategory)
                                        <li><label><input type="checkbox" class="minimal" name="categories[]"> {{ $subCategory->name }}</label></li>
                                    @endforeach
                                    </ul>
                                @endif
                                </li>
                            @endforeach
                            </ul>
                        @endif
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

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product gallery</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('product_images') ? ' has-error' : '' }}">
                            {!! Form::file('product_images[]',['id'=> 'product_images', 'class' => 'file', 'multiple' => 'true', 'data-upload-url' => '#', 'name' => 'product_images']) !!}
                            @include('dashboard::partials.error', ['field' => 'product_images'])
                        </div>
                    </div>
                </div>
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
    </style>
    <script src="{{ asset('themes/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"], input[type="radio"]').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
              radioClass   : 'iradio_minimal-blue'
            });
            $("#feature_image").fileinput({
                uploadUrl: '#',
                uploadAsync: false,
                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                showUpload: false,
            });

            $("#product_images").fileinput({
                uploadUrl: '#',
                uploadAsync: false,
                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                showUpload: false,
            });

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
                            if( $("#"+this.name).length <= 0 ){
                                $("#attributes").append('<div class="form-group"><label for="'+this.name+'" class="col-sm-2 control-label">'+this.name+'</label><div class="col-sm-4"><select class="form-control select2" multiple data-placeholder="Please select '+this.name+'" id="'+this.name+'" name="prattr['+this.id+'][]">'+htmlOptions+'</select></div><div class="col-sm-2"><a class="btn btn-warning" id="btnAddAttr'+this.id+'">+</a></div>');
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
