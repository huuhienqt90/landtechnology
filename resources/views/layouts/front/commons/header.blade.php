<!-- STAR #header -->
<header id="header">
    <div class="container">
        <div class="row">
            <div class="cover-topheader">
                <div class="menu-topheader">
                    <ul class="text-uppercase">
                        @if(Auth::check())
                        <li><a href="{{ route('front.dashboard.index') }}" title="menu topheader">My Account</a></li>
                        <li><a href="#" title="menu topheader">wishlish</a></li>
                        @endif
                        <li><a href="{{ route('front.checkout') }}" title="menu topheader">checkout</a></li>
                        @if(Auth::check())
                            <li>
                                <a href="{{ route('front.dashboard.balances') }}">USD ${{ auth()->user()->getBalances() }}</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="menu topheader">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('register') }}" title="menu topheader">Register</a></li>
                            <li><a href="{{ route('login') }}" title="menu topheader">Login</a></li>
                        @endif
                    </ul>
                </div> <!-- .menu-topheader -->
            </div> <!-- .cover-topheader -->
        </div> <!-- .row -->
    </div> <!-- .container -->
    <div class="container-fluid cover-bg-menu">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ route('front.index') }}"><img src="{{ asset('assets/images/logo.png') }}" class="img-responsive" alt="images logo"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right text-uppercase">
                                <li class="menu-home">
                                    <a href="{{ route('front.index') }}" title="menu home" class="active">Home</a>
                                </li>
                                <li><a href="{{ route('front.product.list') }}">Products</a></li>
                                <li><a href="#">collection</a></li>
                                <li><a href="#">pagest</a></li>
                                <li><a href="#">about us</a></li>
                                <li><a href="#">contact us</a></li>
                                <li class="search">
                                    <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    <div id="sb-search" class="sb-search">
                                        <form>
                                            <input class="sb-search-input" placeholder="Search ...." type="search" value="" name="search" id="search">
                                            <input class="sb-search-submit" type="submit" value="">
                                            <span class="sb-icon-search"></span>
                                        </form>
                                    </div>
                                </li>
                                <li class="menu-cart">
                                    <a href="#" class="a-badge">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        @if( Cart::count() )
                                            <span class="badge badge-default">{{ Cart::count() }}</span>
                                        @else
                                            <span class="badge badge-default">0</span>
                                        @endif
                                    </a>
                                    <div class="hv-cart">
                                        @if( Cart::count() )
                                        <div class="info-cart">
                                            <ul class="mini-cart-items">
                                                @foreach(Cart::content() as $row)
                                                <li class="list-mini-cart-item row">
                                                    <div class="col-md-3"><a href="{{ route('front.product.detail', getProductAttr($row->id, 'slug')) }}" title="{{ $row->name }}" class="img-responsive thumbnail"><img src="{{ getFeatureImage($row->id) }}" alt="images img hover cart img-responsive"></a></div>
                                                    <div class="col-md-7">
                                                        <p>{{ $row->name }}</p>
                                                        <p>Qty: {{ $row->qty }}</p>
                                                        <span>${{ $row->price }}</span>
                                                    </div>
                                                    <div class="col-md-2"><a href="{{ route('front.product.removeFromCart', $row->rowId) }}" title="icon close" class="img-icon-close"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div> <!-- .info-cart -->
                                        <div class="content-cart">
                                            <ul>
                                                <li>
                                                    <span>Total :</span>
                                                </li>
                                                <li>
                                                    <span>${{ Cart::total() }}</span>
                                                </li>
                                            </ul>
                                        </div> <!-- .content-cart -->
                                        <div class="btn-cart">
                                            <ul>
                                                <li><a href="{{ route('front.cart') }}" title="btn cart" class="btn-view-cart">VIEW CART</a></li>
                                                <li><a href="{{ route('front.checkout') }}" title="btn cart" class="btn-view-cart">CHECKOUT</a></li>
                                            </ul>
                                        </div> <!-- .btn-cart -->
                                        @else
                                            <div class="info-cart">
                                                <p>Not found products in cart</p>
                                            </div>
                                        @endif
                                    </div> <!-- .hv-cart -->
                                </li>
                            </ul> <!-- .nav .navbar-nav .navbar-right -->
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .container-fluid -->
</header><!-- END #header -->
