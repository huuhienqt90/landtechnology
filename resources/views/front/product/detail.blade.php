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
<!--START Gallery -->
<div id="js-gallery" class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-product-detail">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active">Sacrificial Chair Design</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <!--Gallery Hero-->
                <div class="gallery__hero">
                    <!-- <a href="" class="gallery__hero-enlarge ir" data-gallery="zoom">Zoom</a> -->

                    <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-01.jpg" class="img-responsive">
                </div>
                <!--Gallery Hero-->

                <!--Gallery Thumbs-->
                <div class="gallery__thumbs">
                    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-01.jpg" data-gallery="thumb" class="is-active">
                        <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-01.jpg" class="img-responsive">
                    </a>
                    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-02.jpg" data-gallery="thumb">
                        <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-02.jpg" class="img-responsive">
                    </a>
                    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-03.jpg" data-gallery="thumb">
                        <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-03.jpg" class="img-responsive">
                    </a>
                    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-03.jpg" data-gallery="thumb">
                        <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-03.jpg" class="img-responsive">
                    </a>
                </div>
                <!--Gallery Thumbs-->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="detail-content">
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
                </div> <!-- .detail-content -->
                <div class="add-to-cart">
                    <p>Size *</p>
                    <select>
                        <option>- Please select -</option>
                    </select>
                    <p>Color *</p>
                    <select>
                        <option>- Please select -</option>
                    </select>
                    <p class="repuired">Repuired Fiields *</p>
                    <div class="quanty">
                        <span>Quanty:</span>
                        <select>
                            <option>01</option>
                        </select>
                    </div> <!-- .quanty -->
                </div> <!-- .add-to-cart -->
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
                    <li class="setting">
                        <a href="#" title="setting"><i class="fa fa-sliders" aria-hidden="true"></i></a>
                    </li> <!-- .setting -->
                </ul> <!-- .btn-add-to-cart -->
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
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-uppercase">Description</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="text-uppercase">Customer Review</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="text-uppercase">Product Tags</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when anunknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronictypesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when anunknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>
        </div>
    </div>
</section> <!-- #tabs-3 -->

<!-- START #upsell -->
<section id="upsell">
    <div class="container">
        <div class="row">
            <div class="title">
                <h3 class="text-uppercase">upsell products</h3>
            </div> <!-- .title -->
            <ul class="list-featured-products col-ms-12">
                <li class="col-md-3 col-sm-3">
                    <a href="#"><img src="{{ asset('assets/images/img-featured-product-1.png') }}" class="img-responsive" alt=""/></a>
                    <div class="news-featured-products">
                            <p>NEW</p>
                        </div> <!-- .news-product -->
                    <ul class="tetx">
                        <li class="text-detail">
                            <p>Sacrificial Chair Design</p>
                            <span>$170.00</span>
                        </li> <!-- .text-detail -->
                        <li class="lock">
                            <a href="#" title="lock">
                                <div class="glyph">
                                    <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                </div>
                            </a>
                        </li> <!-- .lock -->
                    </ul> <!-- .tetx -->
                </li>

                <li class="col-md-3 col-sm-3">
                    <a href="#"><img src="{{ asset('assets/images/img-featured-product-2.png') }}" class="img-responsive" alt=""/></a>
                    <ul class="tetx">
                        <li class="text-detail">
                            <p>Sacrificial Chair Design</p>
                            <span>$170.00</span>
                        </li> <!-- .text-detail -->
                        <li class="lock">
                            <a href="#" title="lock">
                                <div class="glyph">
                                    <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                </div>
                            </a>
                        </li> <!-- .lock -->
                    </ul> <!-- .tetx -->
                </li>

                <li class="col-md-3 col-sm-3">
                    <a href="#"><img src="{{ asset('assets/images/img-featured-product-3.png') }}" class="img-responsive" alt=""/></a>
                    <ul class="tetx">
                        <li class="text-detail">
                            <p>Sacrificial Chair Design</p>
                            <span>$170.00</span>
                        </li> <!-- .text-detail -->
                        <li class="lock">
                            <a href="#" title="lock">
                                <div class="glyph">
                                    <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                </div>
                            </a>
                        </li> <!-- .lock -->
                    </ul> <!-- .tetx -->
                </li>

                <li class="col-md-3 col-sm-3">
                    <a href="#"><img src="{{ asset('assets/images/img-featured-product-4.png') }}" class="img-responsive" alt=""/></a>
                    <div class="news-featured-products">
                            <p>NEW</p>
                        </div> <!-- .news-product -->
                        <div class="sale-featured-products">
                            <p>-15%</p>
                        </div> <!-- .news-product -->
                    <ul class="tetx">
                        <li class="text-detail">
                            <p>Sacrificial Chair Design</p>
                            <span>$170.00</span>
                        </li> <!-- .text-detail -->
                        <li class="lock">
                            <a href="#" title="lock">
                                <div class="glyph">
                                    <div class="fs1" aria-hidden="true" data-icon="&#xe013;"></div>
                                </div>
                            </a>
                        </li> <!-- .lock -->
                    </ul> <!-- .tetx -->
                </li>
            </ul> <!-- .list-featured-products -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> <!-- #upsell -->
@stop