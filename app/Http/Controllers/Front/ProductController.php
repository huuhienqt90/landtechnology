<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\PostCheckoutRequest;
use App\Http\Requests\PostToCartRequest;
use App\Http\Requests\SendOfferRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Repositories\BrandResponsitory;
use App\Repositories\CategoryResponsitory;
use App\Repositories\ProductReviewResponsitory;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductResponsitory;
use Cart;
use App\PaymentMethod\PayPal\PayPal;

class ProductController extends Controller
{
    private $productRepository;
    private $productReviewResponsitory;
    private $categoryResponsitory;
    private $brandResponsitory;
    private $settingRepository;
    private $PayPal;

    public function __construct(ProductResponsitory $productRepository, ProductReviewResponsitory $productReviewResponsitory, CategoryResponsitory $categoryResponsitory, BrandResponsitory $brandResponsitory, SettingRepository $settingRepository){
        $this->productRepository = $productRepository;
        $this->productReviewResponsitory = $productReviewResponsitory;
        $this->categoryResponsitory = $categoryResponsitory;
        $this->brandResponsitory = $brandResponsitory;
        $this->settingRepository = $settingRepository;
        $PayPalConfig = array(
            'Sandbox' =>  true,
            'APIUsername' => !empty( $this->settingRepository->getValueByKey('APIUsername') ) ? $this->settingRepository->getValueByKey('APIUsername') : 'abcabcaaa_api1.gmail.com',
            'APIPassword' => !empty( $this->settingRepository->getValueByKey('APIPassword') ) ? $this->settingRepository->getValueByKey('APIPassword') : 'JHYYGJPYCJFQ8AWF',
            'APISignature' => !empty( $this->settingRepository->getValueByKey('APISignature') ) ? $this->settingRepository->getValueByKey('APISignature') : 'AFcWxV21C7fd0v3bYYYRCpSSRl31A0apSfDtZpJ.RN-aXkvaXdGhAanx'
        );
        $this->PayPal = new PayPal($PayPalConfig);
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
            if( $product->kind == 'hunting'){
                return view('front.product.detail-hunting', compact('product', 'productReview'));
            }else{
                return view('front.product.detail', compact('product', 'productReview'));
            }

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

    /**
     * Show products grid by category slug
     */
    public function productCategory($slug = null){
        $products = $this->productRepository->getProductsByCategory($slug);
        if( $slug && $products->count() > 0 ){
            return view('front.product.grid', compact('products'));
        }else{
            return view('front.404');
        }
    }

    /**
     * Show products grid by brand slug
     */
    public function productBrand($slug = null){
        $products = $this->productRepository->getProductsByBrand($slug);
        if( $slug && $products->count() ){
            return view('front.product.grid', compact('products'));
        }else{
            return view('front.404');
        }

    }

    /**
     * Add product review
     */
    public function storeReview(StoreReviewRequest $request, $id){
        $this->productReviewResponsitory->create(['product_id'=>$id, 'user_id'=>auth()->user()->id, 'rating'=>$request->rating, 'message'=>$request->message, 'status'=>'active']);
        return redirect()->back()->with('alert-success', 'Add review for product success');
    }

    public function sendOffer(SendOfferRequest $request, $slug = null){

        return $this->show($slug);
    }
}
