<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Front'], function() {
    Route::get('/', 'IndexController@index')->name('front.index');
    Route::get('profile/{username?}', 'UserController@showProfile')->name('front.user.showProfile');

    // Register
    Route::get('register', 'UserController@create')->name('front.user.create');
    Route::post('register', 'UserController@store')->name('front.user.store');
    // Login by social
    Route::get('/redirect/{driver}', 'SocialAuthController@redirect')->name('front.social.login');
    Route::get('/callback/{driver}', 'SocialAuthController@callback');
    // Verify
    Route::get('verify/{id?}', 'UserController@showVerify')->name('front.user.verify');
    Route::post('verify/{id?}', 'UserController@verify')->name('front.user.doVerify');

    // PRODUCTS
    Route::group(['prefix' => 'product'], function(){
        // Route::resource('products', 'ProductController');
        Route::get('detail/{slug?}', 'ProductController@show')->name('front.product.detail');
        Route::get('swap/detail/{slug?}', 'ProductController@swapshow')->name('front.product.swapdetail');
        Route::get('hunting/detail/{slug?}', 'ProductController@huntingshow')->name('front.product.huntingdetail');
        // Do swap product
        Route::post('swap/detail', 'ProductController@doSwap')->name('front.product.doSwap');
        // Confirm swap
        Route::get('swap/confirm/{product_id?}-{user_id?}-{created_by?}-{product_by?}', 'ProductController@doConfirmSwap')->name('front.product.doconfirmswap');
        // Hunting
        Route::post('detail/{slug?}', 'ProductController@sendOffer')->name('hunting.sendOffer');
        // Action offer
        Route::post('accept-offer', 'ProductController@acceptOffer')->name('hunting.acceptOffer');
        Route::post('counter-offer', 'ProductController@counter')->name('hunting.counter');
        Route::post('counter-offerNext', 'ProductController@counterNext')->name('hunting.counterNext');
        Route::get('accept-counter/{id?}', 'ProductController@acceptCounter')->name('hunting.acceptCounter');
        Route::get('deny-counter/{id?}', 'ProductController@deniCounter')->name('hunting.deniCounter');
        Route::get('reject-offer/{id?}', 'ProductController@rejectOffer')->name('hunting.rejectOffer');
        Route::get('hunting-success', 'ProductController@showHuntingThankYou')->name('front.hunting.thankYou');
        // End offer
        Route::get('product-category/{slug?}', 'ProductController@productCategory')->name('front.product.category');
        Route::get('brand/{slug?}', 'ProductController@productBrand')->name('front.product.brand');
        Route::get('list', 'ProductController@showList')->name('front.product.list');
        Route::get('grid', 'ProductController@showGrid')->name('front.product.grid');
        // Variation
        Route::get('getVariation', 'ProductController@getProductVariation')->name('front.product.getProductVariation');
        Route::post('variation/{product_id}', 'ProductController@postProductVariationInfo')->name('front.product.postProductVariationInfo');
    });

    // Routes for cart and order page
    Route::get('add-to-cart/{id?}/{quantity?}', 'CartController@addToCart')->name('front.product.addToCart');
    Route::get('add-to-cart-by-ajax', 'CartController@addToCartAjax')->name('front.product.addToCartAjax');
    Route::post('add-to-cart/{id?}', 'CartController@postToCart')->name('front.product.postToCart');
    Route::post('store-review/{id?}', 'ProductController@storeReview')->name('front.product.storeReview');
    Route::get('add-to-favorite/{id?}', 'CartController@addToFavorite')->name('front.product.addToFavorite');
    Route::get('remove-from-cart/{id?}', 'CartController@removeFromCart')->name('front.product.removeFromCart');
    Route::get('cart', 'CartController@showCart')->name('front.cart');
    Route::post('cart', 'CartController@updateCart')->name('front.cart.update');
    Route::get('checkout', 'CartController@showCheckout')->name('front.checkout');
    Route::post('checkout', 'CartController@postCheckout')->name('front.checkout.post');
    Route::get('checkout-success', 'OrderController@showCheckoutThankYou')->name('front.checkout.thankYou');
    Route::get('checkout-fail', 'OrderController@showCheckoutFail')->name('front.checkout.fail');

    Route::group(['middleware' => 'auth', 'prefix' => 'user'], function(){
        // Index dashboard
         Route::get('dashboard', 'DashboardController@index')->name('front.dashboard.index');
         // Edit Account Infomation
         Route::get('edit', 'UserController@edit')->name('front.user.edit');
         Route::post('edit', 'UserController@update')->name('front.user.update');
         // Password
         Route::get('editpass', 'UserController@editPass')->name('front.user.editPass');
         Route::post('editpass', 'UserController@updatePass')->name('front.user.updatePass');
         Route::get('balances', 'UserController@getBalances')->name('front.dashboard.balances');
         // Seller Dashboard
         Route::resource('seller', 'SellerController');
         // Hunting Dashboard
         Route::resource('hunting', 'HuntingController');
         // Swapping Dashboard
         Route::resource('swapping', 'SwappingController');
         Route::get('swap/list-accept-swap', 'SwappingController@listAccept')->name('front.swapping.listAccept');
    });
});
// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('front.index'));
});

// Product List
Breadcrumbs::register('product_list', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List View Products', route('front.product.list'));
});

// Product List
Breadcrumbs::register('product_grid', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Grid View Products', route('front.product.grid'));
});

// Product category
Breadcrumbs::register('product_category', function ($breadcrumbs, $product_cat) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($product_cat->name, route('front.product.category', $product_cat->slug));
});

// Product brand
Breadcrumbs::register('product_brand', function ($breadcrumbs, $product_brand) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($product_brand->name, route('front.product.brand', $product_brand->slug));
});

// Product brand
Breadcrumbs::register('cart', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Cart', route('front.cart'));
});

// Product brand
Breadcrumbs::register('checkout', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Checkout', route('front.checkout'));
});

// Product brand
Breadcrumbs::register('product_detail', function ($breadcrumbs, $products) {
    $breadcrumbs->parent('home');
    if($products->categories->count()){
        foreach ($products->categories as $cat) {
            $breadcrumbs->push($cat->name, route('front.product.category', $cat->slug));
        }
    }
    $breadcrumbs->push($products->name, route('front.product.brand', $products->slug));
});
// Product brand
Breadcrumbs::register('product_hunting_detail', function ($breadcrumbs, $products) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($products->name, route('front.product.huntingdetail', $products->slug));
});

Auth::routes();
