@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Edit swapping product - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Edit swapping product',
        'description'   => 'Welcome from Hello World',
        'image'         => '',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content-dashboard')
<h3 style="visibility: hidden;">Edit Swapping Product</h3>
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
                                {!! Form::open(['route' => ['swapping.update', $product->id], 'files' => true, 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
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
                                                {{ Form::label(null, $errors->has('product_brand')? $errors->first('product_brand') : '', ['class' => 'help-block']) }}
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
                                                        @else
                                                            <option value="{{ $category->id }}"{{ selected(in_array($category->id, array_keys($product->category)), true) }}>{{ $category->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @include('dashboard::partials.error', ['field' => 'category'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('tags', 'Tags', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('tags[]', $arrTags, $arTagId, ['class' => 'form-control tags', 'multiple' => true]) }}
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
                                        <div class="form-group {{ $errors->has('sell_type_id')? 'has-error' : '' }}">
                                            {{ Form::label('sell_type_id', 'Sell Type', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('sell_type_id', $selltypes, $product->sell_type_id, ['class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('sell_type_id')? $errors->first('sell_type_id') : '', ['class' => 'help-block']) }}
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
@stop
