@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Create swapping product - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Login',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content-dashboard')
<h3 style="visibility: hidden;">Create swapping product</h3>
@if ($message = Session::get('success'))
    <div class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! $message !!}
    </div>
    <?php Session::forget('success');?>
@endif
@if ($message = Session::get('error'))
    <div class="custom-alerts alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! $message !!}
    </div>
    <?php Session::forget('error');?>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Swap An Item</h3>
        </div>
        <div class="panel-body">
            <div class="main-content full-width inner-page">
                <div class="background">
                    <div class="pattern">
                        <div class="col-sm-12">
                            <div class="col-sm-12 center-column">
                                {!! Form::open(['route' => 'swapping.store', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
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
                                        <div class="form-group {{ $errors->has('product_brand')? 'has-error' : '' }}">
                                            {{ Form::label('product_brand', 'Product Brand', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('product_brand', $brands, null, ['class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('product_brand')? $errors->first('product_brand') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('category')? 'has-error' : '' }}">
                                            <label for="category" class="col-sm-3 control-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="category">
                                                    <option value="">Please select a category</option>
                                                    @foreach($allCategories as $category)
                                                        @if( $category->getChildren()->count() )
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach($category->getChildren() as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @else
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @include('dashboard::partials.error', ['field' => 'category'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('tags', 'Tags', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('tags[]', $arrTags, null, ['class' => 'form-control tags', 'multiple' => true]) }}
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
                                            });
                                        </script>
                                        <div class="form-group {{ $errors->has('description_short')? 'has-error' : '' }}">
                                            {{ Form::label('description_short', 'Description short', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                <textarea class="textarea" id="description_short" name="description_short" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ Form::getValueAttribute('description_short') }}</textarea>
                                                {{ Form::label(null, $errors->has('description_short')? $errors->first('description_short') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('description')? 'has-error' : '' }}">
                                            {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                <textarea class="textarea" id="description" name="description" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ Form::getValueAttribute('description') }}</textarea>
                                                {{ Form::label(null, $errors->has('description')? $errors->first('description') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('sell_type_id')? 'has-error' : '' }}">
                                            {{ Form::label('sell_type_id', 'Sell Type', ['class' => 'col-sm-3 control-label']) }}
                                            <div class="col-sm-9">
                                                {{ Form::select('sell_type_id', $selltypes, null, ['class' => 'form-control']) }}
                                                {{ Form::label(null, $errors->has('sell_type_id')? $errors->first('sell_type_id') : '', ['class' => 'help-block']) }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-offset-3">
                                                <div class="radio" style="margin-right: 20px;">
                                                    <label for="payment-paypal"><input id="payment-paypal" type="radio" checked value="paypal" name="paymentMethod">&nbsp;&nbsp;PayPal</label>
                                                </div>
                                                <div class="radio">
                                                    <label for="payment-stripe"><input id="payment-stripe" type="radio" value="stripe" name="paymentMethod">&nbsp;&nbsp;Stripe</label>
                                                </div>
                                                <div id="area-payment-stripe">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group mg-top-40">
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
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $("#payment-stripe").change(function() {
                $("#area-payment-stripe").append('<div class="row"><div class="col-md-12"><div class="form-group"><label>Card Number</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-credit-card"></i></span><input type="text" name="card_no" required value="{{ old('card_no') }}" class="form-control" placeholder="Valid Card Number"></div></div></div><div class="col-md-3"><div class="form-group"><label>Expiry Month</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard"></i></span><input type="text" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" class="form-control" required placeholder="MM"></div></div></div><div class="col-md-3"><div class="form-group"><label>Expiry Year</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard"></i></span><input type="text" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" class="form-control" required placeholder="YYYY"></div></div></div><div class="col-md-6"><div class="form-group"><label>CVV No.</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard-o"></i></span><input type="text" name="cvvNumber" required value="{{ old('cvvNumber') }}" class="form-control" placeholder="CVC"></div></div></div><div class="col-md-12"><div class="form-group"><label>Amount</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-usd"></i></span><input type="text" name="amount" required readonly value="{{ $oldCommissionSwap }}" class="form-control" placeholder="0"></div></div></div></div>');
            });
            $("#payment-paypal").change(function() {
                $("#area-payment-stripe").html('');
            });
        });
    </script>
@stop
