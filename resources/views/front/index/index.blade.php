@extends('layouts.front.master')

@section('meta')
    @include('social::meta-article', [
        'title'         => 'Home',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
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
                    <a href="{{ route('front.product.detail') }}" title="images detail">
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
                    <a href="{{ route('front.product.detail') }}" title="images detail">
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
                    <a href="{{ route('front.product.detail') }}" title="images detail">
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
                <h3 class="text-uppercase">new arrivals</h3>
                <p>Claritas est etiam processus dynamicus, qui sequitur.</p>
            </div> <!-- .title-new-arrivals -->
        </div> <!-- .row -->
        <div class="row" style="overflow: hidden;">
            <div class="col-md-12 slider slider-nav">
                <div class="item">
                    <div class="slider-item">
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-1.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
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
                        <a href="{{ route('front.product.detail') }}"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
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
            </div> <!-- END .slider .slider-nav -->
        </div> <!-- .row -->
        <div class="row">
            <div class="cover-detail-content">
                <div class="col-md-6 col-sm-6">
                    <div class="img-detail-content">
                        <img src="{{ asset('assets/images/img-new-arrivals-5.png') }}" class="img-responsive" alt="images detail content">
                        <div class="news-product-detail">
                            <p>NEW</p>
                        </div> <!-- .news-product -->
                        <div class="sale-product-detail">
                            <p>-15%</p>
                        </div> <!-- .news-product -->
                    </div> <!-- .img-detail-content -->
                    </div>
                <div class="detail-content-product">
                    <div class="col-md-6 col-sm-6">
                        <div class="detail-content">
                            <h4 class="text-uppercase">Sacrificial Chair Design</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">10 review(s)</a></li>
                                <li class="breadcrumb-item">Add your review</li>
                            </ol>
                            <span class="tx-sp-cl">$170.00 </span>
                            <span class="tx-sp-line-through">$69.00  </span>
                            <ul class="parameter">
                                <li>Size: <span>large</span></li>
                                <li>Color: <span>Grey white & Brown</span></li>
                                <li>Dimensions: <span>Height: 13cm x Length: 15cm</span></li>
                            </ul> <!-- .parameter -->
                        </div>
                    </div>
                </div> <!-- .detail-content-product -->
            </div> <!-- .cover-detail-content -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #new-arrivals -->

<!-- START #featured-products -->
    <section id="featured-products">
        <div class="container">
            <div class="row">
                <div class="title-new-arrivals">
                    <h3 class="text-uppercase">Freatured Products</h3>
                    <p>Claritas est etiam processus dynamicus, qui sequitur.</p>
                </div> <!-- .title-new-arrivals -->
                <div class="col-md-12 slider">
                    <div class="item">
                        <div class="slider-item">
                            <a href="#"><img src="{{ asset('assets/images/img-new-arrivals-1.png') }}" class="img-responsive" alt=""/></a>
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
                            <a href="#"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
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
                            <a href="#"><img src="{{ asset('assets/images/img-new-arrivals-3.png') }}" class="img-responsive" alt=""/></a>
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
                            <a href="#"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
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
                </div> <!-- .slider -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #featured-products -->

<!-- START #purchase -->
<section id="purchase">
    <div class="container">
        <div class="row"> 
            <div class="content-purchase">
                <a href="#" title="images purchase"><img src="{{ asset('assets/images/img-purchase.png') }}" class="img-responsive" alt="images purchase"></a>
                <div class="text-content-purchase">
                    <h4 class="text-uppercase">
                        <span>Do You Love Us?</span>
                        <span>Purchase This Theme!</span>
                    </h4>
                    <p>Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. </p>
                    <div class="btn-purchase">
                        <a href="#" title="btn purchase" class="text-uppercase">Purchase</a>
                    </div> <!-- .btn-purchase -->
                </div> <!-- .text-content-purchase -->
            </div> <!-- .content-purchase -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #purchase -->

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

<!-- START #sign-up -->
<section id="sign-up">
    <div class="container">
        <div class="row">
            <div class="content-sign-up">
                <h4 class="text-uppercase">sign up to newsletter</h4>
                <p>Subscribe to the Eren mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                <div id="sb-subscribe" class="sb-subscribe">
                    <form>
                        <input class="sb-subscribe-input" placeholder="Subscribe to our newsletter..." type="subscribe" value="" name="search" id="subscribe">
                        <input class="sb-subscribe-submit" type="submit" value="">
                        <span class="sb-icon-subscribe"></span>
                    </form>
                </div>
            </div> <!-- .content-sign-up -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #sign-up -->

<!-- START #testimonials -->
    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <div class="item slider-nav-one">
                        <div class="slider-item">
                            <img src="{{ asset('assets/images/img-testimonials.png') }}" class="img-responsive" alt=""/>
                            <div class="tetx">
                                <h6 class="text-uppercase text-detail">Michel Smith</h6>
                                <a href="#" title="job" class="text-uppercase job">developer</a>
                            </div>
                        </div> <!-- .slider-item -->
                        <div class="slider-item">
                            <img src="{{ asset('assets/images/img-testimonials.png') }}" class="img-responsive" alt=""/>
                            <div class="tetx">
                                <h6 class="text-uppercase text-detail">Michel Smith</h6>
                                <a href="#" title="job" class="text-uppercase job">developer</a>
                            </div>
                        </div> <!-- .slider-item -->
                    </div> <!-- .item -->
                </div>
                <div class="col-md-12">
                    <div class="item slider-for">
                        <div class="text-testimonials">
                            <p>1. Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica.</p>
                        </div>
                        <div class="text-testimonials">
                            <p>2. Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica.</p>
                        </div>
                    </div>
                </div> <!-- .text-testimonials -->
            </div>
            <div class="row">
                <div class="shipping">
                    <ul>
                        <li>
                            <div class="glyph">
                                <div class="fs1" aria-hidden="true" data-icon=""></div>
                            </div>
                            <div class="text-shipping">
                                <h5 class="text-uppercase">free shipping worldwide</h5>
                                <p>Free shipping worldwide</p>
                            </div>
                        </li>
                        <li>
                            <div class="glyph">
                                <div class="fs1" aria-hidden="true" data-icon=""></div>
                            </div>
                            <div class="text-shipping">
                                <h5 class="text-uppercase">free shipping worldwide</h5>
                                <p>Free shipping worldwide</p>
                            </div>
                        </li>
                        <li>
                            <div class="glyph">
                                <div class="fs1" aria-hidden="true" data-icon=""></div>
                            </div>
                            <div class="text-shipping">
                                <h5 class="text-uppercase">free shipping worldwide</h5>
                                <p>Free shipping worldwide</p>
                            </div>
                        </li>
                    </ul>
                </div> <!-- .shipping -->
            </div>
        </div> <!-- .container -->
    </section> <!-- #testimonials -->
@stop