@extends('layouts.front.master')

@section('meta')
	<title>Grid Product</title>
    @include('social::meta-article', [
        'title'         => 'Home',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
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
            <div class="col-md-3 col-sm-3">
                <div class="sidebar">
                    <div class="categories">
                        <h2 class="text-uppercase">categories</h2>
                        <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo">Chair</button>
                        <div id="demo" class="collapse">
                            <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                            <p><a href="#" title="menu collapse">Eyewear</a></p>
                            <p><a href="#" title="menu collapse">Jewelry</a></p>
                            <p><a href="#" title="menu collapse">Shoes</a></p>
                            <p><a href="#" title="menu collapse">Skyrts</a></p>
                        </div> <!-- .collapse -->
                        <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo-1">Woment</button>
                        <div id="demo-1" class="collapse">
                            <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                            <p><a href="#" title="menu collapse">Eyewear</a></p>
                            <p><a href="#" title="menu collapse">Jewelry</a></p>
                            <p><a href="#" title="menu collapse">Shoes</a></p>
                            <p><a href="#" title="menu collapse">Skyrts</a></p>
                        </div> <!-- .collapse -->
                        <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo-2">Kids</button>
                        <div id="demo-2" class="collapse">
                            <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                            <p><a href="#" title="menu collapse">Eyewear</a></p>
                            <p><a href="#" title="menu collapse">Jewelry</a></p>
                            <p><a href="#" title="menu collapse">Shoes</a></p>
                            <p><a href="#" title="menu collapse">Skyrts</a></p>
                        </div> <!-- .collapse -->
                        <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo-3">All Peoducts</button>
                        <div id="demo-3" class="collapse">
                            <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                            <p><a href="#" title="menu collapse">Eyewear</a></p>
                            <p><a href="#" title="menu collapse">Jewelry</a></p>
                            <p><a href="#" title="menu collapse">Shoes</a></p>
                            <p><a href="#" title="menu collapse">Skyrts</a></p>
                        </div> <!-- .collapse -->
                    </div> <!-- .categories -->

                    <div class="shop-by">
                        <h2 class="text-uppercase">Shop by</h2>
                        <div class="Manufacturer">
                            <p class="text-uppercase">Manufacturer</p>
                            <a href="#">Adidas <span class="badge">(10)</span></a>
                            <a href="#">Nike <span class="badge">(9)</span></a>
                            <a href="#">Converse <span class="badge">(11)</span></a>
                            <a href="#">Chanel <span class="badge">(19)</span></a>
                            <a href="#">Gucci <span class="badge">(2)</span></a>
                        </div> <!-- .Manufacturer -->

                        <div class="demo">
                            <span class="text-uppercase title-prince">Price</span>
                            <div id="slider-range" class="range-style"></div>
                            <p>
                                <label for="amount"></label>
                                <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                            </p>
                            <a href="#" title="btn search price">Search</a>
                        </div>

                        <!-- <div class="color-options">
                            <p class="text-uppercase">color options</p>
                            <a href="#">Black <span class="badge">(10)</span></a>
                            <a href="#">White <span class="badge">(9)</span></a>
                            <a href="#">Blue <span class="badge">(11)</span></a>
                            <a href="#">Red <span class="badge">(19)</span></a>
                            <a href="#">Screen <span class="badge">(2)</span></a>
                        </div> <!-- .color-options --> -->

                        <div class="subcategory">
                            <p class="text-uppercase">subcategory</p>
                            <a href="#">Materlal Bag <span class="badge">(10)</span></a>
                            <a href="#">Arreglos <span class="badge">(9)</span></a>
                            <a href="#">Dresses <span class="badge">(11)</span></a>
                            <a href="#">Headphone <span class="badge">(19)</span></a>
                        </div> <!-- .subcategory -->

                        <!-- <div class="size-options">
                            <p class="text-uppercase">size options</p>
                            <a href="#">L <span class="badge">(10)</span></a>
                            <a href="#">M <span class="badge">(9)</span></a>
                            <a href="#">S <span class="badge">(11)</span></a>
                            <a href="#">XL <span class="badge">(19)</span></a>
                            <a href="#">XXL <span class="badge">(2)</span></a>
                        </div> <!-- .size-options --> -->

                    </div> <!-- .shop-by -->
                </div> <!-- .sidebar -->
            </div>
            <div class="col-md-9 col-sm-9">
                <div class="grid-content-detail-list">
                    <div class="show-click">
                        <a href="{{ route('front.product.grid') }}" class="btn btn-default grid-show active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a href="{{ route('front.product.list') }}" class="btn btn-default list-show"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
                        <select>
                            <option>Defaul sorting</option>
                        </select>
                        <span class="text-uppercase">Showing 1-12 of 20 relults</span>
                    </div> <!-- .show-click -->
                </div> <!-- .grid-content-detail-list -->
                <div class="slider col-md-12 col-sm-12">
                    <div class="item col-md-4 col-sm-4">
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
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
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
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-4.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
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
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
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
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
                        <div class="slider-item">
                            <a href="{{ route('front.product.detail') }}" class="product-detail-url"><img src="{{ asset('assets/images/img-new-arrivals-2.png') }}" class="img-responsive" alt=""/></a>
                            <div class="overlay">
                                <a href="#" class="text mg-top-40"><i class="fa fa-compress" aria-hidden="true"></i></a>
                                <a href="#" class="text mg-top-80"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div> <!-- .overlay -->
                            <ul class="tetx">
                                <li class="text-detail">
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                    <div class="item col-md-4 col-sm-4">
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
                                    <h4><a href="#" title="title product">Sacrificial Chair Design</a></h4>
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
                <div class="navigation-page">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <span class="text-uppercase showing">Showing 1-12 of 20 relults</span>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #content-grid -->
@stop