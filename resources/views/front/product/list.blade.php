@extends('layouts.front.master')

@section('meta')
    <title>List Product</title>
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
                        <button type="button" class="btn btn-default grid-show" aria-label="Justify">
                            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-default list-show" aria-label="Justify">
                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                        </button>
                        <select>
                            <option>Defaul sorting</option>
                        </select>
                        <span class="text-uppercase">Showing 1-12 of 20 relults</span>
                    </div> <!-- .show-click -->
                </div> <!-- .grid-content-detail-list -->
                <div class="list-show-content">
                    <ul>
                        <li>
                            <div class="col-md-4 col-sm-4 img-list-show">
                                <a href="{{ route('front.product.detail') }}" title="images products"><img src="{{ asset('assets/images/img-featured-product-4.png') }}" class="img-responsive" alt="images products"></a>
                            </div>
                            <div class="col-md-8 col-sm-8 content-list-show">
                                <h4>Sacrificial Chair Design</h4>
                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
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
                                <ul class="btn-add-to-cart">
                                    <li class="cover-btn-glyph">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;">
                                                <a href="#" title="btn add to cart" class="text-uppercase">Add to cart</a>
                                            </div>
                                        </div>
                                    </li> <!-- .cover-btn-glyph -->
                                    <li class="heart">
                                        <a href="#" title="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    </li> <!-- .heart -->
                                </ul> <!-- .btn-add-to-cart -->
                            </div> <!-- .content-list-show -->
                        </li>
                        <li>
                            <div class="col-md-4 col-sm-4 img-list-show">
                                <a href="{{ route('front.product.detail') }}" title="images products"><img src="{{ asset('assets/images/img-featured-product-1.png') }}" class="img-responsive" alt="images products"></a>
                            </div>
                            <div class="col-md-8 col-sm-8 content-list-show">
                                <h4>Sacrificial Chair Design</h4>
                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
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
                                <ul class="btn-add-to-cart">
                                    <li class="cover-btn-glyph">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;">
                                                <a href="#" title="btn add to cart" class="text-uppercase">Add to cart</a>
                                            </div>
                                        </div>
                                    </li> <!-- .cover-btn-glyph -->
                                    <li class="heart">
                                        <a href="#" title="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    </li> <!-- .heart -->
                                </ul> <!-- .btn-add-to-cart -->
                            </div> <!-- .content-list-show -->
                        </li>
                        <li>
                            <div class="col-md-4 col-sm-4 img-list-show">
                                <a href="{{ route('front.product.detail') }}" title="images products"><img src="{{ asset('assets/images/img-featured-product-5.png') }}" class="img-responsive" alt="images products"></a>
                            </div>
                            <div class="col-md-8 col-sm-8 content-list-show">
                                <h4>Sacrificial Chair Design</h4>
                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
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
                                <ul class="btn-add-to-cart">
                                    <li class="cover-btn-glyph">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;">
                                                <a href="#" title="btn add to cart" class="text-uppercase">Add to cart</a>
                                            </div>
                                        </div>
                                    </li> <!-- .cover-btn-glyph -->
                                    <li class="heart">
                                        <a href="#" title="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    </li> <!-- .heart -->
                                </ul> <!-- .btn-add-to-cart -->
                            </div> <!-- .content-list-show -->
                        </li>
                        <li>
                            <div class="col-md-4 col-sm-4 img-list-show">
                                <a href="{{ route('front.product.detail') }}" title="images products"><img src="{{ asset('assets/images/img-featured-product-6.png') }}" class="img-responsive" alt="images products"></a>
                            </div>
                            <div class="col-md-8 col-sm-8 content-list-show">
                                <h4>Sacrificial Chair Design</h4>
                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. </p>
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
                                <ul class="btn-add-to-cart">
                                    <li class="cover-btn-glyph">
                                        <div class="glyph">
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe013;">
                                                <a href="#" title="btn add to cart" class="text-uppercase">Add to cart</a>
                                            </div>
                                        </div>
                                    </li> <!-- .cover-btn-glyph -->
                                    <li class="heart">
                                        <a href="#" title="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    </li> <!-- .heart -->
                                </ul> <!-- .btn-add-to-cart -->
                            </div> <!-- .content-list-show -->
                        </li>
                    </ul>
                </div> <!-- .list-show -->
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