@extends('layouts.front.master')

@section('meta')
    <title>Checkout - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Checkout - Land Technology',
        'description'   => 'Land Technology',
        'image'         => asset('assets/images/logo.png'),
        'author'        => 'Land Technology'
    ])
@stop

@section('content')
    <section id="content-check-out">
        <div class="container">
            <div class="row">
                <div class="col-md-12 menu-content-check-out">
                    {{ Breadcrumbs::render('checkout') }}
                </div> <!-- .menu-content-check-out -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #content-check-out -->

    <!-- START #show-list-infomation -->
    <section id="show-list-infomation">
        <div class="container">
            {!! Form::model($checkout, ['route' => 'front.checkout.post', 'class' => 'form', 'method' => 'POST']) !!}
            {{ old('billingFirstName') }}
            <div class="row">
                <h1 class="text-uppercase">Checkout</h1>
                    @if ($message = Session::get('success'))
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php Session::forget('success');?>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="custom-alerts alert alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php Session::forget('error');?>
                    @endif
                    @if( Cart::count() )
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title text-uppercase">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span>+</span>Billing and Shipping Information
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <h2>Billing information</h2>
                                            @include('partials.input-text', ['field' => 'billingFirstName', 'label' => 'First name'])
                                            @include('partials.input-text', ['field' => 'billingLastName', 'label' => 'Last name'])
                                            @include('partials.input-text', ['field' => 'billingCompany', 'label' => 'Company'])
                                            @include('partials.input-text', ['field' => 'billingAddress1', 'label' => 'Address 1'])
                                            @include('partials.input-text', ['field' => 'billingAddress2', 'label' => 'Address 2'])
                                            @include('partials.input-text', ['field' => 'billingPostCode', 'label' => 'Postcode / ZIP'])
                                            @include('partials.dropdown-field', ['field' => 'billingCountry', 'options' => $countries, 'label' => 'Country'])
                                            @include('partials.input-text', ['field' => 'billingCity', 'label' => 'Town / City'])
                                            @include('partials.input-text', ['field' => 'billingPhone', 'label' => 'Phone'])
                                            @include('partials.input-text', ['field' => 'billingEmail', 'label' => 'Email'])
                                            <a href="javascript:void(0)" id="autofillShip">Auto fill Shipping information from Billling information</a>
                                        </div>
                                        <div class="col-md-6">
                                            <h2>Shipping information</h2>
                                            @include('partials.input-text', ['field' => 'shippingFirstName', 'label' => 'First name'])
                                            @include('partials.input-text', ['field' => 'shippingLastName', 'label' => 'Last name'])
                                            @include('partials.input-text', ['field' => 'shippingCompany', 'label' => 'Company'])
                                            @include('partials.input-text', ['field' => 'shippingAddress1', 'label' => 'Address 1'])
                                            @include('partials.input-text', ['field' => 'shippingAddress2', 'label' => 'Address 2'])
                                            @include('partials.input-text', ['field' => 'shippingPostCode', 'label' => 'Postcode / ZIP'])
                                            @include('partials.dropdown-field', ['field' => 'shippingCountry', 'options' => $countries, 'label' => 'Country'])
                                            @include('partials.input-text', ['field' => 'shippingCity', 'label' => 'Town / City'])
                                            @include('partials.input-text', ['field' => 'shippingPhone', 'label' => 'Phone'])
                                            @include('partials.input-text', ['field' => 'shippingEmail', 'label' => 'Email'])
                                            <div class="form-group">
                                                <label for="orderNote" class="col-sm-3 control-label">Order Notes</label>
                                                    <input type="hidden" name="orderNote[0][date]" value="{{ Carbon\Carbon::now() }}">
                                                    <input type="hidden" name="orderNote[0][name]" value="{{ Auth::user() ? Auth::user()->username : 'Guest' }}">
                                                    <textarea class="form-control" name="orderNote[0][note]" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title text-uppercase">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="text-uppercase">
                                            <span>+</span>Payment Method
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label for="payment-paypal"><input id="payment-paypal" type="radio" checked value="paypal" name="paymentMethod">PayPal</label>
                                            </div>
                                            <div class="radio">
                                                <label for="payment-stripe"><input id="payment-stripe" type="radio" value="stripe" name="paymentMethod">Stripe</label>
                                            </div>
                                            <div id="area-payment-stripe">
                                            </div>
                                            <!-- <p class="description"><i>We allow PayPal & Stripe method right now!</i></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title text-uppercase">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" class="text-uppercase">
                                            <span>+</span>Order Review
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                    <div class="panel-body">
                                        <h3>Your order detail</h3>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(Cart::content() as $row)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{ $row->name }}&nbsp;
                                                        <strong class="product-quantity">× {{ $row->qty }}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        ${{ number_format( $row->qty * $row->price, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>

                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td>${{ Cart::subtotal() }}</td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Tax</th>
                                                <td>
                                                    ${{ Cart::tax() }}
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><span>${{ Cart::total() }}</span></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <input class="btn btn-default" type="submit" value="Place order" />
                        </div>
                    @else
                        <h3>Your cart is currently empty.</h3>
                    @endif
            </div> <!-- .row -->
            {!! Form::close() !!}
        </div> <!-- .container -->
    </section> <!-- #show-list-infomation -->
@stop
