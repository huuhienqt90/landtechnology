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
                @if (Session::has('error'))
                    <div class="custom-alerts alert {{ Session::has('alert-success') ? 'alert-success' : 'alert-danger' }} fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! Session::get('error') !!}
                    </div>
                @endif
                <div class="breadcrumb-product-detail">
                    {{ Breadcrumbs::render('product_hunting_detail', $product) }}
                </div>
            </div>
            <div class="col-md-12">
                <h1 class="single-hunting-product-title">{{ $product->name }}</h1>
                <div class="hunting-product-meta">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="nav navbar-nav">
                                <li>Sent Offers <span>{!! $product->sentOffers() !!}</span></li>
                                <li>Avg Price <span>{!! $product->avgPrice() !!}$</span></li>
                                <li>Product Budget <span>{!! $product->price !!}$</span></li>
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
                            <h3>Product description</h3>
                            <div class="product-content">{!! $product->description !!}</div>
                            @if( count($product->tags()->get()) )
                                <h3>Tags</h3>
                                <div class="tags">
                                    <ul>
                                        @foreach($product->tags()->get() as $item)
                                        <li class="text-capitalize">{{ $item->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        @if(Auth::check())
                            @if( !$product->isOwnTopic(Auth::user()->id) && $product->Offered(Auth::user()->id) )
                                <div class="col-md-4 text-right"><a href="#send-offer" class="btn text-uppercase btn-primary send-an-offer">Send an offer</a></div>
                            @endif
                        @endif
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

@if($product->isActive())
<section id="userOffers" class="mg-top-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"><h4>List Offers</h4></div>
                    <div class="panel-body">
                        <?php $count = 0; ?>
                        @if(count($listOfferItems) > 0 && isset($listOfferItems))
                            @foreach( $listOfferItems as $item )
                                <div class="media">
                                    <div class="media-left">
                                        @foreach($item->getImages() as $image)
                                            @if($count)
                                                <a href="{{ asset('storage/' . $image->image_path) }}" class="group-image-hunting{{$item->id}}" title="{{ $item->hunting->name }}">
                                                    <img alt="{{ $image->image_name }}" class="media-object" src="{{ asset('storage/'.$image->image_path) }}" class="img-responsive" style="width: 120px; height: 120px;">
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $image->image_path) }}" class="group-image-hunting{{$item->id}}" title="{{ $item->hunting->name }}">
                                                    <img alt="{{ $image->image_name }}" class="media-object" src="{{ asset('storage/'.$image->image_path) }}" class="img-responsive" style="width: 120px; height: 120px; display: none">
                                                </a>
                                            @endif
                                            <?php $count++; ?>
                                            <script type="text/javascript">
                                                jQuery(document).ready(function($) {
                                                    $(".group-image-hunting{{$item->id}}").colorbox({
                                                        rel:'group-image-hunting{{$item->id}}',
                                                        width:"auto", 
                                                        height:"100%"
                                                    });
                                                });
                                            </script>
                                        @endforeach
                                        <?php $count = 0; ?>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $item->user->getFullName() }}</h4>
                                        <ul>
                                            <li><strong>Description:</strong> {!! $item->comment !!}</li>
                                            <li>
                                                <strong>Price: {{ number_format($item->offer_price) }}$</strong>
                                                <input type="hidden" id="val{{$item->id}}" value="{{ $item->offer_price }}">
                                            </li>
                                            @if( isset($item->metas()->where('key','counter_price')->first()->value) && $item->metas()->where('key','counter_price')->first()->value > 0 && ($item->metas()->where('key','counter_price')->first()->value != $item->offer_price) )
                                                <li>
                                                    <strong class="text-danger">Counter Price:</strong> {{ $item->metas()->where('key','counter_price')->first()->value }}$
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @if( Auth::check() && $product->isOwnTopic(Auth::user()->id) )
                                        <div class="media-right">
                                            <div class="form-btn-inline">
                                                <a href="#" data-toggle="modal" data-price="{{ $item->offer_price }}" data-id="{{ $item->id }}" data-target="#payment_method" title="Accept" class="btn btn-success btn-inline"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                <a href="#" data-toggle="modal" data-price="{{ $item->offer_price }}"  data-target="#offer_price" title="Counter" class="btn btn-info btn-inline" data-id="{{ $item->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('hunting.rejectOffer', $item->id) }}" onclick="return confirm('Are you sure?')" title="Reject" class="btn btn-danger btn-inline"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if( Auth::check() && isset($item->metas()->where('key','counter_price')->first()->value) && ($item->metas()->where('key','counter_price')->first()->value < $item->offer_price) && $item->isBuyer(Auth::user()->id) )
                                        <div class="media-right">
                                            <div class="form-btn-inline">
                                                <a href="{{ route('hunting.acceptCounter', $item->id) }}" title="Accept" class="btn btn-success btn-inline"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                <a href="#" data-toggle="modal" data-price="{{ $item->offer_price }}"  data-target="#counter_offer" title="Counter" class="btn btn-info btn-inline" data-id="{{ $item->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('hunting.deniCounter', $item->id) }}" onclick="return confirm('Are you sure?')" title="Reject" class="btn btn-danger btn-inline"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p>Now not user offer product</p>
                        @endif
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Payment Method -->
<div class="modal fade" id="payment_method" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Choose Payment Method</h4>
            </div>
            {!! Form::open(['route' => 'hunting.acceptOffer']) !!}
            <div class="modal-body">
                <input type="hidden" name="price" value="0" />
                <input type="hidden" name="product_offer_id" value="0" />
                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment" id="paypal" value="paypal" checked>
                            Paypal
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment" id="stripe" value="stripe">
                            Stripe
                        </label>
                    </div>
                    <div id="area-payment-stripe"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Payment', ['class' => 'btn btn-success']) }}
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Payment Method -->
<!-- Offer Price -->
<div class="modal fade" id="offer_price" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Counter Price</h4>
            </div>
            {!! Form::open(['route' => 'hunting.counter']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="counter_price">Counter price:</label>
                    <input type="number" min="0" required class="form-control" name="counter_price" placeholder="Please enter price...">
                    <input type="hidden" name="id_offer" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Enter', ['class' => 'btn btn-success']) }}
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End offer price -->
<!-- Offer Price -->
<div class="modal fade" id="counter_offer" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Counter Price</h4>
            </div>
            {!! Form::open(['route' => 'hunting.counterNext']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="counter_price">Counter price:</label>
                    <input type="number" min="0" required class="form-control" name="counter_price" placeholder="Please enter price...">
                    <input type="hidden" name="id_offer" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Enter', ['class' => 'btn btn-success']) }}
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End offer price -->
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
.form-btn-inline {
    display: flex;
    justify-content: start;
}
.btn-inline {
    margin-left: 5px;
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
        var fee = parseFloat(price) * {{ $commissionHuting }};
        var paid = price - fee;
        $('#inputFee').text(fee.toFixed(2));
        $('#inputPaidToYou').text(paid.toFixed(2));
    }
    jQuery(document).ready(function($) {
        $("#stripe").change(function() {
            $("#area-payment-stripe").append('<div class="row"><div class="col-md-12"><div class="form-group"><label>Card Number</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-credit-card"></i></span><input type="text" name="card_no" required value="{{ old('card_no') }}" class="form-control" placeholder="Valid Card Number"></div></div></div><div class="col-md-3"><div class="form-group"><label>Expiry Month</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard"></i></span><input type="text" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" class="form-control" required placeholder="MM"></div></div></div><div class="col-md-3"><div class="form-group"><label>Expiry Year</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard"></i></span><input type="text" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" class="form-control" required placeholder="YYYY"></div></div></div><div class="col-md-6"><div class="form-group"><label>CVV No.</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard-o"></i></span><input type="text" name="cvvNumber" required value="{{ old('cvvNumber') }}" class="form-control" placeholder="CVC"></div></div></div></div></div></div>');
        });
        $("#paypal").change(function() {
            $("#area-payment-stripe").html('');
        });
        $('#payment_method').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var recipient = button.data('price');
          var id = button.data('id');
          var modal = $(this);
          modal.find('.modal-body input[name="price"]').val(recipient);
          modal.find('.modal-body input[name="product_offer_id"]').val(id);
        })
        $('#offer_price').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var recipient = button.data('price');
          var modal = $(this);
          modal.find('.modal-body input[name="id_offer"]').val(id);
          modal.find('.modal-body input[name="counter_price"]').attr('max',recipient - 1);
        })
        $('#counter_offer').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var recipient = button.data('price');
          var modal = $(this);
          modal.find('.modal-body input[name="id_offer"]').val(id);
          modal.find('.modal-body input[name="counter_price"]').attr('max',recipient - 1);
        })
    });
</script>
@stop
