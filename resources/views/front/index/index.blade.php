@extends('layouts.front.master')

@section('meta')
    <title>Home - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Home',
        'description'   => 'Land Technology',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')
<!-- START #banner -->
<section id="banner">
    <div class="layer"></div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ asset('assets/images/banner.png') }}">
                <div class="container carousel-caption">
                    <div class="carousel-caption-content col-md-6 col-sm-6">
                        <span class="text-uppercase">new arrivals</span>
                        <h2 class="text-uppercase">new style</h2>
                        <h3 class="text-uppercase">for lamp</h3>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
                        <a href="#" title="btn shop now" class="text-uppercase">shop now </a>
                    </div> <!-- .carousel-caption-content -->
                    <div class="col-md-6 col-sm-6 carousel-caption-img">
                        <img src="{{ asset('assets/images/img-banner-1.png') }}" alt="images banner">
                    </div> <!-- .carousel-caption-img -->
                </div> <!-- .carousel-caption -->
            </div> <!-- .item .active -->
            <div class="item">
                <img src="{{ asset('assets/images/banner.png') }}">
                <div class="container carousel-caption">
                    <div class="carousel-caption-content col-md-6 col-sm-6">
                        <span class="text-uppercase">new arrivals</span>
                        <h2 class="text-uppercase">new style</h2>
                        <h3 class="text-uppercase">for lamp</h3>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
                        <a href="#" title="btn shop now" class="text-uppercase">shop now </a>
                    </div> <!-- .carousel-caption-content -->
                    <div class="col-md-6 col-sm-6 carousel-caption-img">
                        <img src="{{ asset('assets/images/img-banner-2.png') }}" alt="images banner">
                    </div> <!-- .carousel-caption-img -->
                </div> <!-- .carousel-caption -->
            </div> <!-- .item -->
        </div> <!-- .carousel-inner -->

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section> <!-- END #banner -->

<!-- STAR #product-list -->
<section id="product-list">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="second-effect">
                    <a href="{{ route('front.product.detail') }}" class="bg-img-pro-list" title="images detail">
                    	<img src="{{ asset('assets/images/img-product-list-1.png') }}" alt="images product list">
                	</a>
                    <div class="news-product">
                        <p>-70%</p>
                    </div> <!-- .news-product -->
                    <div class="overlay">
                        <div class="text">
                            <a href="{{ route('front.product.detail') }}" title="title detail" class="text-uppercase">Eren home deco</a>
                            <p>Creative home deco ideal</p>
                            <span>From: $167.00</span>
                        </div> <!-- .text -->
                    </div> <!-- .overlay -->
                </div> <!-- .second-effect -->
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="second-effect">
                    <a href="{{ route('front.product.detail') }}" class="bg-img-pro-list" title="images detail">
                    	<img src="{{ asset('assets/images/img-product-list-2.png') }}" alt="images product list">
                    </a>
                    <div class="overlay">
                        <div class="text">
                            <a href="{{ route('front.product.detail') }}" title="title detail" class="text-uppercase">mega sale off up to</a>
                            <p>Lamps & Lighting</p>
                            <span>From: $127.00</span>
                        </div> <!-- .text -->
                    </div> <!-- .overlay -->
                </div> <!-- .second-effect -->
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="second-effect">
                    <a href="{{ route('front.product.detail') }}" class="bg-img-pro-list" title="images detail">
                    	<img src="{{ asset('assets/images/img-product-list-3.png') }}" alt="images product list">
                    </a>
                    <div class="overlay">
                        <div class="text">
                            <a href="{{ route('front.product.detail') }}" title="title detail" class="text-uppercase">creative table design</a>
                            <p>Tablets & Chair</p>
                            <span>From: $227.00</span>
                        </div> <!-- .text -->
                    </div> <!-- .overlay -->
                </div> <!-- .second-effect -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #product-list -->
<!-- END #product-list -->

<!-- START #new-arrivals -->
<section id="new-arrivals">
    <div class="container">
        <div class="row">
            <div class="title-new-arrivals">
                <h3 class="text-uppercase">New arrivals</h3>
                <p>Claritas est etiam processus dynamicus, qui sequitur.</p>
            </div> <!-- .title-new-arrivals -->
        </div> <!-- .row -->
        <div class="row" style="overflow: hidden;">
            <div class="col-md-12 slider slider-nav">
                @if(isset($featureNewArrivalProducts) && $featureNewArrivalProducts->count())
                    @foreach($featureNewArrivalProducts as $product)
                        <div class="item">
                            <div class="slider-item">
                                <a href="{{ route('front.product.detail', $product->slug) }}" class="product-detail-url"><img src="{{ $product->getFeatureImage() }}" class="img-responsive" alt=""/></a>
                                <div class="news-product-slider">
                                    <p>{{ $product->sellType->name }}</p>
                                </div> <!-- .news-product -->
                                <div class="overlay">
                                    <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                    <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                </div> <!-- .overlay -->
                                <ul class="tetx">
                                    <li class="text-detail">
                                        <h4><a href="{{ route('front.product.detail', $product->slug) }}" title="{{ $product->name }}">{{ $product->name }}</a></h4>
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
                @else
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-1.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="sale-product-slider">
                                <p>-15%</p>
                            </div> <!-- .news-product -->

                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="sale-product-slider">
                                <p>-15%</p>
                            </div> <!-- .news-product -->

                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                @endif
            </div> <!-- END .slider .slider-nav -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #new-arrivals -->

<!-- START #featured-products -->
    <section id="featured-products">
        <div class="container">
            <div class="row">
                <div class="title-new-arrivals">
                    <h3 class="text-uppercase">Hunting Products</h3>
                    <p>Claritas est etiam processus dynamicus, qui sequitur.</p>
                </div> <!-- .title-new-arrivals -->
                <div class="col-md-12 slider">
                    @if(isset($newHuntingProducts) && $newHuntingProducts->count())
                    @foreach($newHuntingProducts as $product)
                        <div class="item col-md-3 col-sm-6">
                            <div class="slider-item">
                                <a href="{{ route('front.product.detail', $product->slug) }}" class="product-detail-url"><img src="{{ $product->getFeatureImage() }}" class="img-responsive" alt="{{ $product->name }}"/></a>
                                <div class="news-product-slider">
                                    <p>NEW</p>
                                </div> <!-- .news-product -->
                                <div class="overlay">
                                    <a href="{{ route('front.product.detail', $product->slug) }}" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                    <a href="{{ route('front.product.detail', $product->slug) }}" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                </div> <!-- .overlay -->
                                <ul class="tetx">
                                    <li class="text-detail">
                                        <h4><a href="{{ route('front.product.detail', $product->slug) }}" title="{{ $product->name }}">{{ $product->name }}</a></h4>
                                        <span class="product-price">{!! $product->getPrice() !!}</span>
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
                @else
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-1.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="sale-product-slider">
                                <p>-15%</p>
                            </div> <!-- .news-product -->

                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                @endif
                </div> <!-- .slider -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #featured-products -->

    <!-- START #featured-products -->
    <section id="featured-products">
        <div class="container">
            <div class="row">
                <div class="title-new-arrivals">
                    <h3 class="text-uppercase">Swapping Products</h3>
                    <p>Claritas est etiam processus dynamicus, qui sequitur.</p>
                </div> <!-- .title-new-arrivals -->
                <div class="col-md-12 slider slider-nav">
                @if(isset($newSwappingProducts) && $newSwappingProducts->count())
                    @foreach($newSwappingProducts as $product)
                        <div class="item col-md-3 col-sm-6">
                            <div class="slider-item">
                                <a href="{{ route('front.product.swapdetail', $product->slug) }}" class="product-detail-url"><img src="{{ $product->getFeatureImage() }}" class="img-responsive" alt="{{ $product->name }}"/></a>
                                <div class="news-product-slider">
                                    <p>NEW</p>
                                </div> <!-- .news-product -->
                                <div class="overlay">
                                    <a href="{{ route('front.product.swapdetail', $product->slug) }}" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                    <a href="{{ route('front.product.swapdetail', $product->slug) }}" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                </div> <!-- .overlay -->
                                <ul class="tetx">
                                    <li class="text-detail">
                                        <h4><a href="{{ route('front.product.swapdetail', $product->slug) }}" title="{{ $product->name }}">{{ $product->name }}</a></h4>
                                    </li> <!-- .text-detail -->
                                </ul>
                            </div> <!-- .slider-item -->
                        </div> <!-- .item -->
                    @endforeach
                @else
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-1.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
                            <div class="news-product-slider">
                                <p>NEW</p>
                            </div> <!-- .news-product -->
                            <div class="sale-product-slider">
                                <p>-15%</p>
                            </div> <!-- .news-product -->

                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                    <div class="item col-md-3 col-sm-6">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="{{ route('front.product.detail') }}" title="title product">Sacrificial Chair Design</a></h4>
                                    <span>$170.00</span>
                                </li> <!-- .text-detail -->
                                <li class="lock">
                                    <a href="#" title="lock">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                        </div>
                                    </a>
                                </li> <!-- .lock -->
                            </ul>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                @endif
                </div> <!-- .slider -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #featured-products -->

<!-- START #out-blog -->
<section id="out-blog">
    <div class="container">
        <div class="row">
            <div class="title-new-arrivals">
                <h3 class="text-uppercase">Form Out Blog</h3>
                <p>Claritas est etiam processus dynamicus, qui sequitur.</p>
            </div> <!-- .title-new-arrivals -->
            <div class="col-md-6 col-sm-6">
                <ul class="content-out-blog">
                    <li class="img-blog">
                        <a href="#" title="images blog"><img src="{{ asset('assets/images/img-blog-1.png') }}" class="img-responsive"></a>
                    </li> <!-- .img-blog -->
                    <li class="text-blog">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">27</li>
                            <li class="breadcrumb-item text-uppercase">April</li>
                        </ol>
                        <h4 class="text-uppercase"><a href="#">Claritas est etiam processus dynamicus.</a></h4>
                        <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum...</p>
                        <a href="#" title="btn blog" class="text-uppercase">read more<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </li> <!-- .text-blog -->
                </ul> <!-- .content-out-blog -->
            </div>
            <div class="col-md-6 col-sm-6">
                <ul class="content-out-blog">
                    <li class="img-blog">
                        <a href="#" title="images blog"><img src="{{ asset('assets/images/img-blog-2.png') }}" class="img-responsive"></a>
                    </li> <!-- .img-blog -->
                    <li class="text-blog">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">21</li>
                            <li class="breadcrumb-item text-uppercase">April</li>
                        </ol>
                        <h4 class="text-uppercase"><a href="#">Claritas est etiam processus dynamicus.</a></h4>
                        <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum...</p>
                        <a href="#" title="btn blog" class="text-uppercase">read more<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </li> <!-- .text-blog -->
                </ul> <!-- .content-out-blog -->
            </div>
        </div> <!-- .row -->

        <div class="row" style="overflow: hidden;">
            <div class="col-md-12 blog-face slider-nav">
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog-2.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog-3.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog-4.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog-2.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog-3.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog-4.png') }}"></a>
                </div>
                <div class="logo-face">
                    <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-face-blog.png') }}"></a>
                </div>
            </div> <!-- .blog-face -->
        </div>

    </div> <!-- .container -->
</section> <!-- #out-blog -->
@stop
