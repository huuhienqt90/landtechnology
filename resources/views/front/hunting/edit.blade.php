@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Dashboard - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Login',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content-dashboard')
<h3 style="visibility: hidden;">Edit Hunting product</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit An Item</h3>
        </div>
        <div class="panel-body">
            <div class="main-content full-width inner-page">
                <div class="background">
                    <div class="pattern">
                        <div class="col-sm-12">
                            <div class="col-sm-12 center-column">
                                {!! Form::open(['route' => ['hunting.update', $product->id], 'files' => true, 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                                {{ method_field('PUT') }}
                                    <fieldset>
                                        <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
                                            {{ Form::label('name', 'Product Title', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('name', $product->name, ['placeholder' => 'Product Title', 'class' => 'form-control', 'id' => 'name']) }}
                                                {{ Form::label(null, $errors->has('name')? $errors->first('name') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('slug')? 'has-error' : '' }}">
                                            {{ Form::label('slug', 'Slug', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('slug', $product->slug, ['placeholder' => 'Slug Product Title', 'class' => 'form-control', 'id' => 'slug', 'readonly' => true]) }}
                                                {{ Form::label(null, $errors->has('slug')? $errors->first('slug') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('product_brand')? 'has-error' : '' }}">
                                            {{ Form::label('product_brand', 'Product Brand', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('product_brand', $brands, $product->product_brand, ['class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('product_')? $errors->first('product_brand') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('category') ? ' has-error' : ''}}">
                                           <label for="category" class="col-sm-3 control-label">Category</label>
                                           <div class="col-sm-9">
                                                <select class="form-control select2" name="category">
                                                    <option value="">Please select a category</option>
                                                    @foreach($categories as $category)
                                                        @if( $category->getChildren()->count() )
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach($category->getChildren() as $item)
                                                                    <option value="{{ $item->id }}" {{ selected(in_array($item->id, array_keys($product->category)), true) }}>{{ $item->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @include('dashboard::partials.error', ['field' => 'category'])
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('original_price')? 'has-error' : '' }}">
                                            {{ Form::label('original_price', 'Price', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('original_price', $product->original_price, ['placeholder' => 'Price', 'class' => 'form-control', 'id' => 'original_price']) }}
                                                {{ Form::label(null, $errors->has('original_price')? $errors->first('original_price') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('sale_price')? 'has-error' : '' }}">
                                            {{ Form::label('sale_price', 'Sale Price', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('sale_price', $product->sale_price, ['placeholder' => 'Sale Price', 'class' => 'form-control', 'id' => 'sale_price']) }}
                                                {{ Form::label(null, $errors->has('sale_price')? $errors->first('sale_price') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('feature_image') ? ' has-error' : '' }}">
                                            <label for="feature_image" class="col-sm-3 control-label">Feature Image</label>
                                            <div class="col-sm-9">
                                                {!! Form::file('feature_image',['id'=>'feature_image', 'class' => 'file', 'data-upload-url' => '#', 'name' => 'feature_image']) !!}
                                                @include('dashboard::partials.error', ['field' => 'feature_image'])
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $("#feature_image").fileinput({
                                                uploadUrl: '#',
                                                uploadAsync: false,
                                                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                                                showUpload: false,

                                                initialPreviewAsData: true,
                                                initialPreview: [
                                                    "{{ asset('storage/'.$product->feature_image) }}"
                                                ],
                                                initialPreviewConfig: [
                                                    {caption: "{{ Form::getValueAttribute('feature_image') }}", size: 329892, width: "120px", url: "{{ route('dashboard.delimg', $product->id) }}", key: "{{ Form::getValueAttribute('feature_image') }}"},
                                                ]
                                            });
                                        </script>
                                        <div class="form-group {{ $errors->has('product_images') ? ' has-error' : '' }}">
                                            <label for="product_images" class="col-sm-3 control-label">Product Images</label>
                                            <div class="col-sm-9">
                                                {!! Form::file('product_images',['id'=>'product_images', 'class' => 'file', 'data-upload-url' => '#', 'multiple' => 'true', 'name' => 'product_images'.'[]']) !!}
                                                @include('dashboard::partials.error', ['field' => 'product_images'])
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $("#product_images").fileinput({
                                                uploadUrl: '#',
                                                uploadAsync: false,
                                                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                                                showUpload: false,
                                                overwriteInitial: false,
                                                initialPreviewAsData: true,
                                                initialPreview: [
                                                    @foreach ($productImages as $image)
                                                        "{{ asset('storage/'.$image->image_path) }}",
                                                    @endforeach
                                                ],
                                                initialPreviewConfig: [
                                                    @foreach ($productImages as $image)
                                                        {caption: "{{ $image->image_name }}", size: 329892, width: "120px", url: "{{ route('dashboard.delProductImg', $image->id) }}", key: "{{ $image->id }}"},
                                                    @endforeach
                                                ]
                                            });
                                        </script>
                                        <div class="form-group {{ $errors->has('description_short')? 'has-error' : '' }}">
                                            {{ Form::label('description_short', 'Description short', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                <textarea class="textarea" id="description_short" name="description_short" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $product->description_short !!}</textarea>
                                                {{ Form::label(null, $errors->has('description_short')? $errors->first('description_short') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('description')? 'has-error' : '' }}">
                                            {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                <textarea class="textarea" id="description" name="description" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $product->description !!}</textarea>
                                                {{ Form::label(null, $errors->has('description')? $errors->first('description') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('key_words')? 'has-error' : '' }}">
                                            {{ Form::label('key_words', 'Key words', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('key_words', $product->key_words, ['placeholder' => 'Key words', 'class' => 'form-control', 'id' => 'key_words']) }}
                                                {{ Form::label(null, $errors->has('key_words')? $errors->first('key_words') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('sell_type_id')? 'has-error' : '' }}">
                                            {{ Form::label('sell_type_id', 'Sell Type', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('sell_type_id', $selltypes, $product->sell_type_id, ['class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('sell_type_id')? $errors->first('sell_type_id') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('weight')? 'has-error' : '' }}">
                                            {{ Form::label('weight', 'Weight', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('weight', $product->weight, ['placeholder' => 'Weight', 'class' => 'form-control', 'id' => 'weight']) }}
                                                {{ Form::label(null, $errors->has('weight')? $errors->first('weight') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('Location')? 'has-error' : '' }}">
                                            {{ Form::label('location', 'location', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('location', $product->location, ['placeholder' => 'Location', 'class' => 'form-control', 'id' => 'location']) }}
                                                {{ Form::label(null, $errors->has('location')? $errors->first('location') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('stock')? 'has-error' : '' }}">
                                            {{ Form::label('stock', 'Stock', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('stock', $product->stock, ['placeholder' => 'Stock', 'class' => 'form-control', 'id' => 'stock']) }}
                                                {{ Form::label(null, $errors->has('stock')? $errors->first('stock') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="text-center mg-top-20">
                                        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                htmlOptions += '<option value="'+v.trim()+'">'+v.trim()+'</option>';
                            });
                            if( $("#"+this.name + this.id).length <= 0 ){
                                $("#attributes").append('<div class="form-group"><label for="'+this.name+'" class="col-sm-3 control-label">'+this.name+'</label><div class="col-sm-7"><select class="form-control select2" multiple data-placeholder="Please select '+this.name+'" id="'+this.name+this.id+'" name="prattr['+this.id+'][]">'+htmlOptions+'</select></div><div class="col-sm-2"><a class="btn btn-warning" id="btnAddAttr'+this.id+'">+</a></div>');
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
