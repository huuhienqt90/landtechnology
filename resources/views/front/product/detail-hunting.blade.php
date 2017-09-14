@extends('layouts.front.master')
@section('headScript')
<!-- File Input -->
<link rel="stylesheet" href="{{ asset('themes/dashboard/dist/css/fileinput.min.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('themes/dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<script src="{{ asset('themes/dashboard/dist/js/fileinput.min.js') }}"></script>
<style type="text/css">
    .kv-file-upload{
        display: none;
    }
</style>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('themes/dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stop
@section('meta')
    <title>{{ $product->name . " - " . config('app.name', 'Laravel') }}</title>
    @include('social::meta-article', [
        'title'         => $product->name . " - " . config('app.name', 'Laravel'),
        'description'   => $product->short_description,
        'image'         => asset('storage/'.$product->feature_image),
        'author'        => config('app.name', 'Laravel')
    ])
@stop

@section('content')
<!--START Gallery -->
<div id="js-gallery" class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-product-detail">
                    {{ Breadcrumbs::render('product_detail', $product) }}
                </div>
            </div>
            <div class="col-md-12">
                <h1 class="single-hunting-product-title">{{ $product->name }}</h1>
                <div class="hunting-product-meta">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="nav navbar-nav">
                                <li>Sent Offers <span>{!! $product->sentOffers() !!}</span></li>
                                <li>Avg Price <span>{!! $product->avgPrice() !!}</span></li>
                                <li>Product Budget <span>{!! $product->getPrice() !!}</span></li>
                                <li>Visit <span>{!! $product->view() !!}</span></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="hunting-product-status">
                                Status <span>{!! $product->status !!}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hunting-product-description">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Product desciption</h3>
                            <div class="product-content">{!! $product->description !!}</div>
                            <h3>Product category</h3>
                            <div class="product-category">{{ $product->categories->first()->name }}</div>
                        </div>
                        <div class="col-md-4 text-right"><a href="#send-offer" class="btn text-uppercase btn-primary send-an-offer">Send an offer</a></div>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</div><!--.gallery-->
<!-- Gallery -->
<?php
    $display = 'none';
    if(count($errors) ){
        $display = 'block';
    }
?>
<section id="send-offer" style="display: {{ $display }};">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Send an offer</h3>
                {!! Form::open(['route' => ['hunting.sendOffer', $product->slug], 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                    <div class="form-group{{ $errors->has('inputPrice') ? ' has-error' : '' }}">
                        <label for="inputPrice" class="col-sm-2 control-label">Your price</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="inputPrice" id="inputPrice" placeholder="Your price">
                            @include('partials.error', ['field' => 'inputPrice'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFee" class="col-sm-2 control-label">Fee</label>
                        <div class="col-sm-3">
                            $<strong id="inputFee">0</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPaidToYou" class="col-sm-2 control-label">Paid to you</label>
                        <div class="col-sm-3">
                            $<strong id="inputPaidToYou">0</strong>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('inputPhotos') ? ' has-error' : '' }}">
                        <label for="inputPhotos" class="col-sm-2 control-label">Photos</label>
                        <div class="col-sm-8">
                            <input type="file" name="inputPhotos[]" multiple class="form-control" id="inputPhotos" placeholder="Photos">
                            @include('partials.error', ['field' => 'inputPhotos'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('textareaComment') ? ' has-error' : '' }}">
                        <label for="textareaComment" class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-8">
                            <textarea class="form-control textarea" name="textareaComment" id="textareaComment"></textarea>
                            @include('partials.error', ['field' => 'textareaComment'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-primary text-uppercase">Send</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</section>

<style type="text/css">
.hunting-product-meta {
    background: #f5f5f5;
    padding: 10px;
    margin-bottom: 20px;
}
.hunting-product-meta span {
    display: block;
    font-size: 120%;
    color: #79B6C8;
    margin-top: 10px;
    font-weight: bold;
}
.hunting-product-meta ul.nav.navbar-nav {
    background: #FFF;
    padding: 10px;
    border-radius: 3px;
    -moz-box-shadow:    inset 0 0 10px #cdcdcd;
    -webkit-box-shadow: inset 0 0 10px #cdcdcd;
    box-shadow:         inset 0 0 10px #cdcdcd;
}
.hunting-product-meta ul.nav.navbar-nav li{
    margin-right: 10px;
    text-align: center;
    font-weight: bold;
    border-right: 1px solid #cdcdcd;
    padding-right: 10px;
}
.hunting-product-meta ul.nav.navbar-nav li:last-child{
    border: none;
}
.hunting-product-status {
    display: inline-block;
    background: #FFF;
    padding: 10px 80px;
    border-radius: 3px;
    color: #61AB00;
    font-weight: bold;
    text-transform: uppercase;
    -moz-box-shadow:    inset 0 0 10px #cdcdcd;
    -webkit-box-shadow: inset 0 0 10px #cdcdcd;
    box-shadow:         inset 0 0 10px #cdcdcd;
    text-align: center;
}
.hunting-product-status span{
    color: #61AB00;
}
</style>
<script type="text/javascript">
    $("#inputPhotos").fileinput({
        uploadUrl: '#',
        uploadAsync: false,
        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
        showUpload: false,
    });
    $('.textarea').wysihtml5();
    $('.send-an-offer').click(function(){
        $('#send-offer').stop().slideToggle('slow');
        return false;
    });
    var inputPrice = $('#inputPrice');
    inputPrice.change(changeFeePrice);
    inputPrice.keyup(changeFeePrice);
    function changeFeePrice(){
        var price = $('#inputPrice').val();
        var fee = parseFloat(price) * 0.1;
        var paid = price - fee;
        $('#inputFee').text(fee.toFixed(2));
        $('#inputPaidToYou').text(paid.toFixed(2));
    }
</script>
@stop
