@extends('layouts.front.master')

@section('meta')
	<title>Grid Product</title>
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
                {{ Breadcrumbs::render('product_grid') }}
            </div> <!-- .content-grid-title -->
            @include('layouts.front.commons.product-sidebar')
            <div class="col-md-9 col-sm-9">
                <div class="grid-content-detail-list">
                    <div class="show-click">
                        <a href="{{ route('front.product.grid') }}" class="btn btn-default grid-show active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a href="{{ route('front.product.list') }}" class="btn btn-default list-show"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
                        @if(isset($products) && $products->count() )
                        <span class="text-uppercase">Showing {{ $products->firstItem()  }} - {{ $products->lastItem()  }} of {{ $products->total() }} relults</span>
                        @endif
                    </div> <!-- .show-click -->
                </div> <!-- .grid-content-detail-list -->
                @if(isset($products) && $products->count() )
                <div class="slider col-md-12 col-sm-12">
                    @foreach($products as $product)
                        <div class="item col-md-4 col-sm-4">
                            <div class="slider-item">
                                <a href="{{ route('front.product.detail', $product->slug) }}" class="product-detail-url"><img src="{{ $product->getFeatureImage() }}" class="img-responsive" alt="{{ $product->name }}"/></a>
                                <div class="overlay">
                                    <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                    <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                </div> <!-- .overlay -->
                                <ul class="tetx">
                                    <li class="text-detail">
                                        <h4><a href="{{ route('front.product.detail', $product->slug) }}" title="title product">{{ $product->name }}</a></h4>
                                        {!! $product->getPrice() !!}
                                    </li> <!-- .text-detail -->
                                    <li class="lock">
                                        <a href="{{ route('front.product.addToCart', $product->id, 1) }}" title="lock">
                                            <div class="glyph">
                                                <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                            </div>
                                        </a>
                                    </li> <!-- .lock -->
                                </ul>
                            </div> <!-- .slider-item -->
                        </div> <!-- .item -->
                    @endforeach
                </div> <!-- .slider -->
                <div class="navigation-page">
                    <nav aria-label="Page navigation">
                        {!! $products->links() !!}
                    </nav>
                    <span class="text-uppercase showing">Showing {{ $products->firstItem()  }} - {{ $products->lastItem()  }} of {{ $products->total() }} results</span>
                </div>
                @else
                    <div class="grid-content-detail-list"><h3>Not found products</h3></div>
                @endif
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #content-grid -->
@stop
