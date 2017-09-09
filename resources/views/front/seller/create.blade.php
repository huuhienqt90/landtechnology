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
<h3 style="visibility: hidden;">Edit My Account</h3>
@if(Session::has('msgOk'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Well done!</strong> {{ Session::get('msgOk') }}
    </div>
@endif
@if(Session::has('msgEr'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> {{ Session::get('msgEr') }}
    </div>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sell An Item</h3>
        </div>
        <div class="panel-body">
            <div class="main-content full-width inner-page">
                <div class="background">
                    <div class="pattern">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-9 center-column">
                                            {!! Form::open(['route' => 'seller.store', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                                <fieldset>
                                                    <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
                                                        {{ Form::label('name', 'Product Title', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('name', old('name'), ['placeholder' => 'Product Title', 'class' => 'form-control', 'id' => 'name']) }}
                                                            {{ Form::label(null, $errors->has('name')? $errors->first('name') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('slug')? 'has-error' : '' }}">
                                                        {{ Form::label('slug', 'Slug', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('slug', old('slug'), ['placeholder' => 'Slug Product Title', 'class' => 'form-control', 'id' => 'slug', 'readonly' => true]) }}
                                                            {{ Form::label(null, $errors->has('slug')? $errors->first('slug') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('original_price')? 'has-error' : '' }}">
                                                        {{ Form::label('original_price', 'Price', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('original_price', old('original_price'), ['placeholder' => 'Price', 'class' => 'form-control', 'id' => 'original_price']) }}
                                                            {{ Form::label(null, $errors->has('original_price')? $errors->first('original_price') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('discount')? 'has-error' : '' }}">
                                                        {{ Form::label('discount', 'Discount', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('discount', old('discount'), ['placeholder' => 'Discount', 'class' => 'form-control', 'id' => 'discount']) }}
                                                            {{ Form::label(null, $errors->has('discount')? $errors->first('discount') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('price_after_discount')? 'has-error' : '' }}">
                                                        {{ Form::label('price_after_discount', 'Price after discount', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('price_after_discount', old('price_after_discount'), ['placeholder' => 'Price after discount', 'class' => 'form-control', 'id' => 'price_after_discount']) }}
                                                            {{ Form::label(null, $errors->has('price_after_discount')? $errors->first('price_after_discount') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('sale_price')? 'has-error' : '' }}">
                                                        {{ Form::label('sale_price', 'Sale Price', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('sale_price', old('sale_price'), ['placeholder' => 'Sale Price', 'class' => 'form-control', 'id' => 'sale_price']) }}
                                                            {{ Form::label(null, $errors->has('sale_price')? $errors->first('sale_price') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('display_price')? 'has-error' : '' }}">
                                                        {{ Form::label('display_price', 'Display Price', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('display_price', old('display_price'), ['placeholder' => 'Display Price', 'class' => 'form-control', 'id' => 'display_price']) }}
                                                            {{ Form::label(null, $errors->has('display_price')? $errors->first('display_price') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('feature_image') ? ' has-error' : '' }}">
                                                        {{ Form::label('feature_image', 'Feature Image', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            @if (Form::getValueAttribute('feature_image'))
                                                                <img id="feature_image-prev" style="max-height:150px; border: 1px solid #cdcdcd; border-radius: 3px; overflow: hidden; margin-right: 10px; margin-bottom: 10px; padding: 2px;" src="{{ asset('storage/'.Form::getValueAttribute('feature_image')) }}"/>
                                                            @else
                                                                <img id="feature_image-prev" style="max-height:150px" />
                                                            @endif
                                                            {!! Form::file('feature_image',['id'=>'feature_image']) !!}
                                                            {{ Form::label(null, $errors->has('feature_image')? $errors->first('feature_image') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('product_images') ? ' has-error' : '' }}">
                                                        {{ Form::label('product_images', 'Product Images', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            @if( count(Form::getValueAttribute('product_images')) )
                                                            <div class="product_images-list-image">
                                                                @foreach(Form::getValueAttribute('product_images') as $imgID => $image)
                                                                    <div class="current-image-item" id="image-item-{{ $imgID }}">
                                                                        <img src="{{ asset('storage/'.$image) }}" />
                                                                        <button type="button" class="btn btn-box-tool delete-image" data-id="{{ $imgID }}"><i class="fa fa-times"></i></button>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div id="input-remove-product_images"></div>
                                                            @endif
                                                            <div id="product_images-list-image"></div>
                                                            {!! Form::file('product_images'.'[]',['id'=>'product_images', 'multiple' => true]) !!}
                                                            {{ Form::label(null, $errors->has('product_images')? $errors->first('product_images') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('description')? 'has-error' : '' }}">
                                                        {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            <textarea class="textarea" id="description" name="description" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ Form::getValueAttribute('description') }}</textarea>
                                                            {{ Form::label(null, $errors->has('description')? $errors->first('description') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('product_brand')? 'has-error' : '' }}">
                                                        {{ Form::label('product_brand', 'Product Brand', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::select('product_brand', $brands, null, ['class' => 'form-control']) }}
                                                            {{ Form::label(null, $errors->has('product_')? $errors->first('product_brand') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('category')? 'has-error' : '' }}">
                                                        {{ Form::label('category', 'Category', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {!! Form::select('category'.'[]', $categories, Form::getValueAttribute('category'), ['class' => 'form-control select2', 'multiple' => true, 'data-placeholder' => 'Select category']) !!}
                                                            {{ Form::label(null, $errors->has('category')? $errors->first('category') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('key_words')? 'has-error' : '' }}">
                                                        {{ Form::label('key_words', 'Key words', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('key_words', old('key_words'), ['placeholder' => 'Key words', 'class' => 'form-control', 'id' => 'key_words']) }}
                                                            {{ Form::label(null, $errors->has('key_words')? $errors->first('key_words') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('sell_type_id')? 'has-error' : '' }}">
                                                        {{ Form::label('sell_type_id', 'Sell Type', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::select('sell_type_id', $selltypes, null, ['class' => 'form-control']) }}
                                                            {{ Form::label(null, $errors->has('sell_type_id')? $errors->first('sell_type_id') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('weight')? 'has-error' : '' }}">
                                                        {{ Form::label('weight', 'Weight', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('weight', old('weight'), ['placeholder' => 'Weight', 'class' => 'form-control', 'id' => 'weight']) }}
                                                            {{ Form::label(null, $errors->has('weight')? $errors->first('weight') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('Location')? 'has-error' : '' }}">
                                                        {{ Form::label('location', 'location', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('location', old('location'), ['placeholder' => 'Location', 'class' => 'form-control', 'id' => 'location']) }}
                                                            {{ Form::label(null, $errors->has('location')? $errors->first('location') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('stock')? 'has-error' : '' }}">
                                                        {{ Form::label('stock', 'Stock', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('stock', old('stock'), ['placeholder' => 'Stock', 'class' => 'form-control', 'id' => 'stock']) }}
                                                            {{ Form::label(null, $errors->has('stock')? $errors->first('stock') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('sold_units')? 'has-error' : '' }}">
                                                        {{ Form::label('sold_units', 'Sold units', ['class' => 'col-sm-3 control-label']) }}
                                                        <div class="col-sm-9">
                                                            {{ Form::text('sold_units', old('sold_units'), ['placeholder' => 'Sold units', 'class' => 'form-control', 'id' => 'sold_units']) }}
                                                            {{ Form::label(null, $errors->has('sold_units')? $errors->first('sold_units') : '', ['class' => 'help-block']) }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="text-center mg-top-20">
                                                    {{ Form::submit('Sell', ['class' => 'btn btn-primary']) }}
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop