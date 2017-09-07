@extends('layouts.front.master')

@section('meta')
    <title>List Product</title>
    @include('social::meta-article', [
        'title'         => 'List Products',
        'description'   => 'List Products',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')

<!-- START #bg-title -->
<section id="bg-title-grid">
    <div class="conteiner-fulid">
        <div class="img-bg-title-grid">
            <img src="{{ asset('assets/images/bg-grid.png') }}" class="img-responsive" alt="images bg title grid">
        </div> <!-- .img-bg-title-grid -->
    </div>
    <div class="container">
        <div class="row">
            <div class="content-bg-title-grid">
                <h1 class="text-uppercase">creative design<p>lighting furniture</p></h1>
                <p>Typi non habent claritatem insitam.</p>
                <a href="#" title="btn grid" class="text-uppercase">view collection</a>
            </div> <!-- .content-bg-title-grid -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #bg-title -->

<!-- START #content-grid -->
<section id="content-grid">
    <div class="container">
        <div class="row">
            <div class="content-grid-title">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Chair</li>
                </ol>
            </div> <!-- .content-grid-title -->
            @include('layouts.front.commons.product-sidebar')
            <div class="col-md-9 col-sm-9">
                <div class="grid-content-detail-list">
                    <div class="show-click">
                        <a href="{{ route('front.product.grid') }}" class="btn btn-default grid-show"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a href="{{ route('front.product.list') }}" class="btn btn-default list-show active"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
                        <select name="order">
                            <option value="desc">Default sorting</option>
                        </select>
                        @if(isset($products) && $products->count() )
                        <span class="text-uppercase">Showing {{ $products->firstItem()  }} - {{ $products->lastItem()  }} of {{ $products->total() }} results</span>
                        @endif
                    </div> <!-- .show-click -->
                </div> <!-- .grid-content-detail-list -->
                @if(isset($products) && $products->count() )
                <div class="list-show-content">
                    <ul>
                        @foreach($products as $product)
                            <li>
                                <div class="col-md-4 col-sm-4 img-list-show">
                                    <a href="{{ route('front.product.detail', $product->slug) }}" title="{{ $product->name }}"><img src="{{ \App\Models\Product::getFeatureImage($product->id) }}" class="img-responsive" alt="{{ $product->name }}"></a>
                                </div>
                                <div class="col-md-8 col-sm-8 content-list-show">
                                    <h4>{{ $product->name }}</h4>
                                    <p>{!! $product->description !!}</p>
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
                                        <li class="breadcrumb-item"><a href="#">10 review(s)</a></li>
                                        <li class="breadcrumb-item">Add your review</li>
                                    </ol>
                                    {!! $product->getPrice() !!}
                                    <ul class="btn-add-to-cart">
                                        <li class="cover-btn-glyph">
                                            <div class="glyph">
                                                <div class="fs1" aria-hidden="true" data-icon="&#xe013;">
                                                    <a href="{{ route('front.product.addToCart', $product->id, 1) }}" title="btn add to cart" class="text-uppercase">Add to cart</a>
                                                </div>
                                            </div>
                                        </li> <!-- .cover-btn-glyph -->
                                        <li class="heart">
                                            <a href="{{ route('front.product.addToFavorite', $product->id, 1) }}" title="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                        </li> <!-- .heart -->
                                    </ul> <!-- .btn-add-to-cart -->
                                </div> <!-- .content-list-show -->
                            </li>
                        @endforeach
                    </ul>
                </div> <!-- .list-show -->
                <div class="navigation-page">
                    <nav aria-label="Page navigation">
                        {!! $products->links() !!}
                    </nav>
                    <span class="text-uppercase showing">Showing {{ $products->firstItem()  }} - {{ $products->lastItem()  }} of {{ $products->total() }} results</span>
                </div>
                @else
                    <div class="list-show-content">
                        <h3>Not found products</h3>
                    </div>
                @endif
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #content-grid -->

@stop