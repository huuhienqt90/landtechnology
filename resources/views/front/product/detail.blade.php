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
                    <p>{{ $product->description_short }}</p>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <?php
                            if( $product->reviews->sum('rating') && $product->reviews->count()){
                                $currentRating = ceil($product->reviews->sum('rating') / $product->reviews->count());
                            }else{
                                $currentRating = false;
                            }
                            ?>
                            @if($currentRating === false)
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            @else
                                @for($i=1; $i<=$currentRating; $i++)
                                    <i class="fa fa-star-o active" aria-hidden="true"></i>
                                @endfor
                            @endif
                        </li>
                        <li class="breadcrumb-item"><a href="#review">{{ $product->reviews->count() }} review(s)</a></li>
                        <li class="breadcrumb-item">Add your review</li>
                    </ol>
                    <div class="single-product-price">{!! $product->getPrice() !!}</div>
                </div> <!-- .detail-content -->
                <form action="{{ route('front.product.postToCart', $product->id, 1) }}" method="post">
                    {{ csrf_field() }}
                    <div class="add-to-cart">
                        @if($product->attributes->groupBy('attribute_id')->count())
                            @foreach($product->attributes->groupBy('attribute_id')->all() as $attr)
                                @include('partials.'.$attr->first()->attribute->group->type, ['field' => 'attrs['.$attr->first()->attribute->id.']', 'label' => $attr->first()->attribute->name, 'options' => $attr->toArray()])
                            @endforeach
                        @endif
                        <p class="required">Required Field *</p>
                        <div class="quantity">
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="label-control">Quantity</label>
                                <!-- <input type="number" name="quantity" value="1" class="form-control" min="1" max="{{ $product->stock }}" /> -->
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="quantity" class="form-control input-number" value="1" min="1" max="{{ $product->stock }}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quantity">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                              </div>
                                @include('partials.error', ['field' => 'quantity'])
                            </div>
                        </div> <!-- .quanty -->
                    </div> <!-- .add-to-cart -->
                    <ul class="btn-add-to-cart">
                        <li class="cover-btn-glyph">
                            <div class="glyph">
                                <button class="fs1 btn text-uppercase" type="submit" aria-hidden="true" data-icon="&#xe013;">Add to cart</button>
                            </div>
                        </li> <!-- .cover-btn-glyph -->
                        <li class="heart">
                            <a href="{{ route('front.product.addToFavorite', $product->id, 1) }}" title="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </li> <!-- .heart -->
                    </ul> <!-- .btn-add-to-cart -->
                </form>
                <div class="list">
                    <img src="{{ asset('assets/images/list-add-to-cart-product.png') }}" title="images list">
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</div><!--.gallery-->
<!-- Gallery -->

<!-- START #tabs-3 -->
<section id="tabs-3">
    <div class="container">
        <div class="row">
             <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" {{ $errors->has('rating') || $errors->has('message') ? '' : 'class="active"' }}><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-uppercase">Description</a></li>
                <li role="presentation" {{ $errors->has('rating') || $errors->has('message') ? 'class="active"' : '' }}><a href="#review" aria-controls="profile" role="tab" data-toggle="tab" class="text-uppercase">Customer Review</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="text-uppercase">Product Tags</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane{{ $errors->has('rating') || $errors->has('message') ? '' : ' active' }}" id="home">
                    {!! $product->description !!}
                </div>
                <div role="tabpanel" class="tab-pane{{ $errors->has('rating') || $errors->has('message') ? 'active' : '' }}" id="review">
                    @if($product->reviews->count())
                        <ul class="media-list">
                        @foreach($product->reviews as $review)
                            <li class="media">
                                <div class="media-left">
                                    <a href="{{ route('front.user.showProfile', $review->user->username ) }}">
                                    {!! $review->user->getAvatarByEmail(80) !!}
                                    {{ str_limit($review->user->getFullName(), $limit = 10, $end = '...') }}
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p>
                                        @for($i=1; $i <= $review->rating; $i++)
                                            <i class="fa fa-star-o active" aria-hidden="true"></i>
                                        @endfor
                                    </p>
                                    {!! $review->message !!}
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    @else
                        <h3>Be the first to review this product!</h3>
                    @endif
                    {!! Form::model($productReview, ['route' => ['front.product.storeReview', $product->id], 'files' => true]) !!}
                        <div class="form-group {{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label for="rating" class="control-label">Rating</label>
                            <div class="rating">
                                <label class="review-item-star">
                                    <input type="radio" name="rating" value="5">
                                    <span class="review-item"><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                </label>
                                <label class="review-item-star">
                                    <input type="radio" name="rating" value="4">
                                    <span class="review-item"><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                </label>
                                <label class="review-item-star">
                                    <input type="radio" name="rating" value="3">
                                    <span class="review-item"><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                </label>
                                <label class="review-item-star">
                                    <input type="radio" name="rating" value="2">
                                    <span class="review-item"><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                </label>
                                <label class="review-item-star">
                                    <input type="radio" name="rating" value="1">
                                    <span class="review-item"><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                </label>
                            </div>
                            @include('dashboard::partials.error', ['field' => 'rating'])
                        </div>
                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="control-label">Message</label>
                            {!! Form::textarea('message', old('message'), ['class'=>'form-control']) !!}
                            @include('partials.error', ['field' => 'message'])
                        </div>
                        <div class="form-group">
                            {!! Form::button('Review', ['class' => 'btn btn-success btn-default', 'type' => 'submit']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    {!! $product->key_words !!}
                </div>
            </div>
        </div>
    </div>
</section> <!-- #tabs-3 -->

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
@stop
