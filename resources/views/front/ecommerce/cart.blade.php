@extends('layouts.front.master')

@section('meta')
    <title>Cart - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Cart - Land Technology',
        'description'   => 'Land Technology',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')
    <!-- START #content-shopping -->
    <section id="content-shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-12 menu-content-shopping">
                    {{ Breadcrumbs::render('cart') }}
                </div> <!-- .menu-content-shopping -->
                <div class="shopping-cart-table">
                    <h1 class="text-uppercase">Shopping cart</h1>
                    @if( Cart::count() )
                        {!! Form::open(['route' => 'front.cart.update', 'method' => 'POST']) !!}
                        <table>
                            <tr class="title-table">
                                <th class="text-uppercase">Product photo</th>
                                <th class="text-uppercase">Product name</th>
                                <th class="text-uppercase description">Description</th>
                                <th class="text-uppercase">Price</th>
                                <th class="text-uppercase">Quantity</th>
                                <th class="text-uppercase">Total Price</th>
                                <th></th>
                            </tr> <!-- .title-table -->
                            @foreach(Cart::content() as $row)
                            <tr class="content-table">
                                <th>
                                    <a href="{{ route('front.product.detail', \App\Models\Product::find($row->id)->slug) }}" title="{{ $row->name }}"><img src="{{ \App\Models\Product::getFeatureImage($row->id) }}" class="img-responsive" alt="images shooping cart"></a>
                                </th>
                                <th>
                                    <a href="#" title="title product shopping cart">{{ $row->name }}</a>
                                </th>
                                <th>
                                    <p>{{ $row->name }}</p>
                                </th>
                                <th>
                                    <span>${{ number_format($row->price, 2) }}</span>
                                </th>
                                <th>
                                    <input type="number" name="quantity[{{ $row->rowId }}]" placeholder="0" value="{{ $row->qty }}">
                                </th>
                                <th>
                                    <span>${{ number_format($row->price * $row->qty, 2) }}</span>
                                </th>
                                <th>
                                    <a href="{{ route('front.product.removeFromCart', $row->rowId) }}" title="close"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </th>
                            </tr> <!-- .content-table -->
                            @endforeach
                        </table>
                        <div class="continue">
                            <a href="{{ route('front.product.grid') }}" title="btn continue shopping" class="text-uppercase">CONTINUE SHOPPING</a>
                            <div class="button-continue">
                                <button type="text" type="submit" name="cartType" value="update" class="text-uppercase">UPDATE SHOPPING CART</button>
                                <button type="text" type="submit" name="cartType" value="clear" class="text-uppercase">CLEAR SHOPPING CART</button>
                            </div> <!-- .button-continue -->
                        </div> <!-- .continue -->
                        {!! Form::close() !!}
                    @else
                        <h3>Your cart is currently empty.</h3>
                    @endif

                </div> <!-- .shopping-cart-table -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #content-shopping -->
    @if( Cart::count() )
    <!-- START #cart-totals -->
    <section id="cart-totals">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 calculate-shipping">
                    <h3 class="text-uppercase">Calculate shipping</h3>
                    <div class="select-your-counttry">
                        <span>Select your Counttry</span>
                        <select class="form-control">
                            <option>US</option>
                        </select>
                    </div> <!-- .select-your-counttry -->
                    <div class="select-your-state">
                        <span>Select your State</span>
                        <select>
                            <option>State/City</option>
                        </select>
                    </div> <!-- .select-your-state -->
                    <div class="zip-code">
                        <span>Zip Code</span>
                        <input type="text" name="text zip code" placeholder="Zip Code">
                    </div> <!-- .zip-code -->
                    <button type="text" class="text-uppercase">Update Shipping</button>
                </div> <!-- .calculate-shipping -->

                <div class="col-md-4 col-sm-4 coupon-code">
                    <h3 class="text-uppercase">Coupon code</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <div class="coupon-code-input">
                        <span>Coupon code</span>
                        <input type="text" name="text calculate shipping" placeholder="98F101192">
                    </div> <!-- .coupon-code-input -->
                    <button type="text" class="text-uppercase">REdeem code</button>
                </div> <!-- .coupon-code -->

                <div class="col-md-4 col-sm-4 cart-totals">
                    <h3 class="text-uppercase">Cart totals</h3>
                    <ul>
                        <li>
                            <p>Cart Subtotal</p>
                            <span>${{ Cart::subtotal() }}</span>
                        </li>
                        <li>
                            <p>Shipping and Tax</p>
                            <span>${{ Cart::tax() }}</span>
                        </li>
                        <li>
                            <p>Cart Totals</p>
                            <span>${{ Cart::total() }}</span>
                        </li>
                    </ul>
                    <button  onclick="location.href='{{ route('front.checkout') }}';" type="text" class="text-uppercase">Proceed to checkout</button>
                </div> <!-- .cart-totals -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- .cart-totals -->
    @endif
@stop
