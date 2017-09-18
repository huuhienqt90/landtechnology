@extends('layouts.front.master')

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
                @if (Session::has('msgOk'))
                    <div class="custom-alerts alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! Session::get('msgOk') !!}
                    </div>
                @endif
                <div class="breadcrumb-product-detail">
                    {{ Breadcrumbs::render('product_detail', $product) }}
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <!--Gallery Hero-->
                <div class="gallery__hero">
                    <img src="{{ $product->getFeatureImage() }}" class="img-responsive">
                </div>
                <!--Gallery Hero-->

                <!--Gallery Thumbs-->
                <div class="gallery__thumbs">
                    <a href="{{ $product->getFeatureImage() }}" data-gallery="thumb" class="is-active col-md-3 col-sm-3">
                        <img src="{{ $product->getFeatureImage() }}" class="img-responsive">
                    </a>

                    @if($product->images->count() )
                        @foreach($product->images as $img)
                            <a href="{{ asset('storage/'.$img->image_path) }}" data-gallery="thumb" class="col-md-3 col-sm-3">
                                <img src="{{ asset('storage/'.$img->image_path) }}" class="img-responsive">
                            </a>
                        @endforeach
                    @endif
                </div>
                <!--Gallery Thumbs-->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="detail-content">
                    <h4>{{ $product->name }}</h4>
                    <p>{!! $product->description_short !!}</p>
                </div> <!-- .detail-content -->
                    <div class="add-to-cart">
                        @if($product->attributes->groupBy('attribute_id')->count())
                            @foreach($product->attributes->groupBy('attribute_id')->all() as $attr)
                                @include('partials.'.$attr->first()->attribute->group->type, ['field' => 'attrs['.$attr->first()->attribute->id.']', 'label' => $attr->first()->attribute->name, 'options' => $attr->toArray()])
                            @endforeach
                        @endif
                    </div> <!-- .add-to-cart -->
                    @if(Auth::user())
                        @if( $product->seller_id !== Auth::user()->id && $countSwapItems == 0 )
                            @if( count($acceptSwap) > 0 )
                            <ul class="btn-add-to-cart">
                                <li class="cover-btn-glyph">
                                    <div class="glyph">
                                        <button class="btn btn-danger text-uppercase" disabled type="button" data-toggle="modal" data-target=".listproswap" aria-hidden="true" data-icon="&#xe013;">Changed</button>
                                    </div>
                                </li> <!-- .cover-btn-glyph -->
                            </ul> <!-- .btn-add-to-cart -->
                            @else
                            <ul class="btn-add-to-cart">
                                <li class="cover-btn-glyph">
                                    <div class="glyph">
                                        <button class="fs1 btn text-uppercase" type="button" data-toggle="modal" data-target=".listproswap" aria-hidden="true" data-icon="&#xe013;">Swap</button>
                                    </div>
                                </li> <!-- .cover-btn-glyph -->
                            </ul> <!-- .btn-add-to-cart -->
                            @endif
                        @endif
                    @else
                        <p>Please login to swap! <a href="{{ route('front.user.login') }}">Click here</a> to login.</p>
                    @endif
                <div class="list">
                    <img src="{{ asset('assets/images/list-add-to-cart-product.png') }}" title="images list">
                </div>

                <!-- START #tabs-3 -->
                <section id="tabs-3">
                    <div class="container">
                        <div class="row">
                             <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active" {{ $errors->has('rating') || $errors->has('message') ? '' : 'class="active"' }}><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-uppercase">Description</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane{{ $errors->has('rating') || $errors->has('message') ? '' : ' active' }}" id="home">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section> <!-- #tabs-3 -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</div><!--.gallery-->
<!-- Gallery -->
<section id="userSwap" class="mg-top-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"><h4>List user ...</h4></div>
                    <div class="panel-body">
                        @if(count($listSwapItems) > 0 && isset($listSwapItems))
                            @foreach( $listSwapItems as $item )
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ route('front.product.swapdetail', $item->product->slug) }}" target="_blank">
                                            <img alt="{{ $item->product->name }}" class="media-object" src="{{ asset('storage/'.$item->product->feature_image) }}" class="img-responsive" style="width: 64px; height: 64px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $item->user->getFullName() }}</h4>
                                        <a href="{{ route('front.product.swapdetail', $item->product->slug) }}" target="_blank">{{ $item->product->name }}</a>
                                    </div>
                                    <div class="media-right"> 
                                        @if(Auth::user() != null && $item->user_id == Auth::user()->id)
                                            <a href="{{ route('front.product.doconfirmswap', ['product_id' => $product->id, 'user_id' => $product->seller_id,'created_by' => $item->created_by, 'product_by' => $item->product_by]) }}" title="Agree" class="btn btn-warning btn-xs"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Now not user swapping product</p>
                        @endif
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style type="text/css">
    .color-attr-item input[type="radio"], .text-attr-item input[type="radio"], .rating input[type="radio"] {
        visibility: hidden;
        width: 1px;
        height: 1px;
    }
    .color-attr-item input[type="radio"] + span, .text-attr-item input[type="radio"] + span {
        display: inline-block;
        height: 40px;
        width: 40px;
        border-radius: 50%;
        border: 2px solid #FFF;
        cursor: pointer;
    }
    .text-attr-item input[type="radio"] + span{
        border-radius: 5px;
        padding: 5px 10px;
        width: auto;
        height: auto;
        background: #cdcdcd;
    }
    .color-attr-item input[type="radio"]:checked + span, .text-attr-item input[type="radio"]:checked + span {
        box-shadow: 0 0 4px #000;
    }
    .rating {
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: left;
    }
    .rating label{
        margin-top: 0;
    }
    .rating > label:hover,
    .rating > input:checked + span,
    .rating > label:hover ~ label,
    .rating > label.hovered,
    .rating > label.hovered ~ label{
        color: #79B6C8;
    }
    button.btn.btn-default.btn-number {
        padding: 13px 15px 10px 15px;
    }
    .input-group{
        width: 170px;
    }
</style>
<div class="modal fade listproswap" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">List Swapping Product</h4>
            </div>
            {!! Form::open(['route' => 'front.product.doSwap']) !!}
            <div class="modal-body">
                @if(!Auth::user())
                    <p>Please login to continue! <a href="{{ route('front.user.login') }}">Click here</a> to login.</p>
                @else
                    @if(isset($arrListProductSwaps) && ($arrListProductSwaps != null))
                    <div class="form-group">
                        <label class="control-label">Product</label>
                        {!! Form::select('productSwap', $arrListProductSwaps, null, ['placeholder' => 'Select product to swap', 'class' => 'form-control', 'required' => true]); !!}
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="seller_id" value="{{ $product->seller_id }}">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Swap note</label>
                        <textarea class="form-control" name="swapNote" required="true"></textarea>
                    </div>
                    @else
                        <p>You not product swap</p>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                @if(Auth::user())
                    <button type="submit" class="btn btn-primary">Recommend</button>
                @endif
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop