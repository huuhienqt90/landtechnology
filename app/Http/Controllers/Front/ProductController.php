<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\PostToCartRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Repositories\ProductReviewResponsitory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductResponsitory;
use Cart;

class ProductController extends Controller
{
    private $productRepository;
    private $productReviewResponsitory;

    public function __construct(ProductResponsitory $productRepository, ProductReviewResponsitory $productReviewResponsitory){
        $this->productRepository = $productRepository;
        $this->productReviewResponsitory = $productReviewResponsitory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug = null)
    {
        $product = $this->productRepository->findBy('slug', $slug);
        $productReview = $this->productReviewResponsitory;
        if( !empty($slug) && isset($product->id) && $product->id){
            return view('front.product.detail', compact('product', 'productReview'));
        }else{
            return redirect()->route('front.index')->with('alert-danger', 'Product not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug = null)
    {
        $product = $this->productRepository->findBy('slug', $slug);
        if( !empty($slug) && isset($product->id) && $product->id){
            return view('front.product.detail');
        }else{
            return redirect()->route('front.index')->with('alert-danger', 'Product not found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showList()
    {
        $products = $this->productRepository->paginate(12);
        return view('front.product.list', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid()
    {
        $products = $this->productRepository->paginate(12);
        return view('front.product.grid', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToCart($id = 0, $quantity = 1, $options = [], $type = 'redirect'){
        $product = $this->productRepository->find($id);
        $cart = Cart::add($id, $product->name, $quantity, $product->display_price, $options);
        if( $type == 'redirect'){
            return redirect()->back()->with('alert-success', 'Add product '.$product->name.' success');
        }else{
            return response()->json($cart);
        }
    }

    public function postToCart(PostToCartRequest $request, $id = 0){
        $product = $this->productRepository->find($id);
        Cart::add($id, $product->name, $request->quantity, $product->display_price);
        return redirect()->back()->with('alert-success', 'Add product '.$product->name.' success');
    }

    public function removeFromCart($id = 0){
        Cart::remove($id);
        return redirect()->back()->with('alert-success', 'Remove product in cart success');
    }

    public function addToFavorite($id = 0, $quantity = 1, $options = [], $type = 'redirect'){
        $product = $this->productRepository->find($id);
        Cart::instance('wishlist')->add($id, $product->name, $quantity, $product->display_price, $options);
        return redirect()->back()->with('alert-success', 'Add product to wish list success');
    }

    public function productCategory($slug = null){
        $products = $this->productRepository->paginate(12);
        return view('front.product.grid', compact('products'));
    }

    public function productCategoryBrand($slug = null){
        $products = $this->productRepository->paginate(12);
        return view('front.product.grid', compact('products'));
    }

    public function storeReview(StoreReviewRequest $request, $id){
        $this->productReviewResponsitory->create(['product_id'=>$id, 'user_id'=>auth()->user()->id, 'rating'=>$request->rating, 'message'=>$request->message, 'status'=>'active']);
        return redirect()->back()->with('alert-success', 'Add product to wish list success');
    }
}
