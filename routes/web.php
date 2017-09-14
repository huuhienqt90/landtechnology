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
Auth::routes();

Route::group(['namespace' => 'Front'], function() {
    Route::get('/', 'IndexController@index')->name('front.index');
    Route::get('profile/{username?}', 'UserController@showProfile')->name('front.user.showProfile');

    // Register
    Route::get('register', 'UserController@create')->name('front.user.create');
    Route::post('register', 'UserController@store')->name('front.user.store');
    // Login
    Route::get('check/login', 'UserController@showLogin')->name('login');
    Route::get('login', 'UserController@showLogin')->name('front.user.login');
    Route::post('login', 'UserController@doLogin')->name('front.user.doLogin');
    // Logout
    Route::get('logout', 'UserController@logout')->name('front.user.logout');
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
        Route::post('detail/{slug?}', 'ProductController@sendOffer')->name('hunting.sendOffer');
        Route::get('product-category/{slug?}', 'ProductController@productCategory')->name('front.product.category');
        Route::get('brand/{slug?}', 'ProductController@productBrand')->name('front.product.brand');
        Route::get('list', 'ProductController@showList')->name('front.product.list');
        Route::get('grid', 'ProductController@showGrid')->name('front.product.grid');
    });

    // Routes for cart and order page
    Route::get('add-to-cart/{id?}/{quantity?}', 'CartController@addToCart')->name('front.product.addToCart');
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
         // Seller Dashboard
         Route::resource('seller', 'SellerController');
         Route::resource('hunting', 'HuntingController');
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
