@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Dashboard - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Create hunting product',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content-dashboard')
<h3 style="visibility: hidden;">Create hunting product</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Hunt An Item</h3>
        </div>
        <div class="panel-body">
            <div class="main-content full-width inner-page">
                <div class="background">
                    <div class="pattern">
                        <div class="col-sm-12">
                            <div class="col-sm-12 center-column">
                                {!! Form::open(['route' => 'hunting.store', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
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
                                        <div class="form-group {{ $errors->has('price')? 'has-error' : '' }}">
                                            {{ Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::text('price', old('price'), ['placeholder' => 'Price', 'class' => 'form-control', 'id' => 'price']) }}
                                                {{ Form::label(null, $errors->has('price')? $errors->first('price') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('country_id')? 'has-error' : '' }}">
                                            {{ Form::label('country_id', 'Ship to', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('country_id', $countries, null, ['placeholder' => 'Pick a country...', 'class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('country_id')? $errors->first('country_id') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('tags', 'Tags', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('tags[]', $arrTags, null, ['class' => 'form-control tags', 'multiple' => true]) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('image_path') ? ' has-error' : '' }}">
                                            <label for="image_path" class="col-sm-3 control-label">Feature Image</label>
                                            <div class="col-sm-9">
                                                {!! Form::file('image_path',['id'=>'image_path', 'class' => 'file', 'data-upload-url' => '#', 'name' => 'image_path']) !!}
                                                @include('dashboard::partials.error', ['field' => 'image_path'])
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $("#image_path").fileinput({
                                                uploadUrl: '#',
                                                uploadAsync: false,
                                                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
                                                showUpload: false,
                                            });
                                        </script>
                                        <div class="form-group {{ $errors->has('description')? 'has-error' : '' }}">
                                            {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                <textarea class="textarea" id="description" name="description" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ Form::getValueAttribute('description') }}</textarea>
                                                {{ Form::label(null, $errors->has('description')? $errors->first('description') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            {{ Form::submit('Submit', ['class' => 'btn btn-success btn-block']) }}
                                        </div>
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
