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
use App\Repositories\SwapItemResponsitory;
use App\Repositories\UserResponsitory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductResponsitory;
use Cart;
use App\PaymentMethod\PayPal\PayPal;
use App\Mail\SwapProduct;
use App\Mail\AcceptSwap;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    private $productRepository;
    private $productReviewResponsitory;
    private $categoryResponsitory;
    private $brandResponsitory;
    private $settingRepository;
    private $PayPal;
    private $swapItemResponsitory;
    private $userResponsitory;

    public function __construct(ProductResponsitory $productRepository, ProductReviewResponsitory $productReviewResponsitory, CategoryResponsitory $categoryResponsitory, BrandResponsitory $brandResponsitory, SettingRepository $settingRepository, SwapItemResponsitory $swapItemResponsitory, UserResponsitory $userResponsitory){
        $this->productRepository = $productRepository;
        $this->productReviewResponsitory = $productReviewResponsitory;
        $this->categoryResponsitory = $categoryResponsitory;
        $this->brandResponsitory = $brandResponsitory;
        $this->settingRepository = $settingRepository;
        $this->swapItemResponsitory = $swapItemResponsitory;
        $this->userResponsitory = $userResponsitory;
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
     * [swapshow description]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function swapshow($slug = null) {
        $product = $this->productRepository->findBy('slug', $slug);
        $listSwapItems = $this->swapItemResponsitory->findAllBy('product_id', $product->id);
        $swapItems = [];
        $arrListProductSwaps = [];
        $i = 0;
        if(auth()->user()){
            $listProductSwaps = $this->productRepository->findWhere(['seller_id' => auth()->user()->id, 'kind' => 'swapping', 'status' => 'active']);
            foreach($listProductSwaps as $productSwaps) {
                $arrListProductSwaps[$productSwaps->id] = $productSwaps->name;
                $swapItems[] = $this->swapItemResponsitory->findWhere(['product_id' => $product->id, 'user_id' => $product->seller_id, 'created_by' => auth()->user()->id, 'product_by' => $productSwaps->id]);
            }

            $acceptSwap = $this->swapItemResponsitory->findWhere(['product_id' => $product->id, 'user_id' => $product->seller_id, 'created_by' => auth()->user()->id, 'status' => 'accept']);
        }

        

        foreach($swapItems as $item) {
            if(count($item) > 0) {
                $i++;
            }
        }

        $countSwapItems = $i;
        if( !empty($slug) && isset($product->id) && $product->id){
            if( $product->kind == 'swapping'){
                return view('front.product.detail-swapping', compact('product', 'arrListProductSwaps','countSwapItems','listSwapItems','acceptSwap'));
            }else{
                return view('front.product.detail', compact('product'));
            }

        }else{
            return redirect()->route('front.index')->with('alert-danger', 'Product not found');
        }
    }

    public function doSwap(Request $request) {
        $product_by = $request->productSwap;
        $note = $request->swapNote;
        $product_id = $request->product_id;
        $user_id = $request->seller_id;
        $created_by = auth()->user()->id;
        $param = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'created_by' => $created_by,
            'product_by' => $product_by,
            'note' => $note
        ];
        $result = $this->swapItemResponsitory->create($param);
        $user = $this->userResponsitory->find($user_id);
        if($result) {
            Mail::to($user->email)->send(new SwapProduct($result->note));
            return redirect()->back()->with('msgOk', 'Recommed swap product success!');
        }
        return redirect()->back()->with('msgOk', 'You already swap for this product!');
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

    /**
     * [doConfirmSwap description]
     * @param  [type] $created_by [description]
     * @param  [type] $product_by [description]
     * @return [type]             [description]
     */
    public function doConfirmSwap($product_id, $user_id, $created_by, $product_by) {
        if(auth()->user() != null) {
            $this->swapItemResponsitory->updateStatusItem('accept', $product_id, $user_id, $created_by, $product_by);
            $param['status'] = 'accept';
            $userIsSwap = $this->userResponsitory->find($user_id);
            $userSwap = $this->userResponsitory->find($created_by);
            $this->productRepository->update($param, $product_id);
            $this->productRepository->update($param, $product_by);
            Mail::to($userIsSwap->email)->send(new AcceptSwap());
            Mail::to($userSwap->email)->send(new AcceptSwap());
            return redirect()->route('front.swapping.listAccept')->with('msgOk', 'Product accept swap success!!');
        }
        return redirect()->route('front.user.login');
    }
}
