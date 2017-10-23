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
use App\Repositories\HuntingResponsitory;
use App\Repositories\ProductOfferResponsitory;
use App\Repositories\HuntingImageResponsitory;
use App\Repositories\ProductOfferMetaResponsitory;
use App\Repositories\PaymentHistoryResponsitory;
use App\Repositories\ProductVariationResponsitory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductResponsitory;
use Cart;
use App\Mail\SwapProduct;
use App\Mail\AcceptSwap;
use App\Mail\HuntingSuccess;
use Illuminate\Support\Facades\Mail;

use Hamilton\PayPal\PayPal;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $productRepository;
    private $productReviewResponsitory;
    private $categoryResponsitory;
    private $brandResponsitory;
    private $settingRepository;
    private $swapItemResponsitory;
    private $userResponsitory;
    private $huntingResponsitory;
    private $productOfferResponsitory;
    private $huntingImageResponsitory;
    private $PayPal;
    private $productOfferMetaResponsitory;
    private $paymentHistoryResponsitory;
    private $productVariationResponsitory;

    public function __construct(ProductResponsitory $productRepository, ProductReviewResponsitory $productReviewResponsitory, CategoryResponsitory $categoryResponsitory, BrandResponsitory $brandResponsitory, SettingRepository $settingRepository, SwapItemResponsitory $swapItemResponsitory, UserResponsitory $userResponsitory, HuntingResponsitory $huntingResponsitory, ProductOfferResponsitory $productOfferResponsitory, HuntingImageResponsitory $huntingImageResponsitory, ProductOfferMetaResponsitory $productOfferMetaResponsitory, PaymentHistoryResponsitory $paymentHistoryResponsitory, ProductVariationResponsitory $productVariationResponsitory){
        $this->productRepository = $productRepository;
        $this->productReviewResponsitory = $productReviewResponsitory;
        $this->categoryResponsitory = $categoryResponsitory;
        $this->brandResponsitory = $brandResponsitory;
        $this->settingRepository = $settingRepository;
        $this->swapItemResponsitory = $swapItemResponsitory;
        $this->userResponsitory = $userResponsitory;
        $this->huntingResponsitory = $huntingResponsitory;
        $this->productOfferResponsitory = $productOfferResponsitory;
        $this->huntingImageResponsitory = $huntingImageResponsitory;
        $this->productOfferMetaResponsitory = $productOfferMetaResponsitory;
        $this->productVariationResponsitory = $productVariationResponsitory;

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
            }else if( $product->product_type == "variable" ){
                return view('front.product.detail-variable', compact('product', 'productReview'));
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

    public function huntingshow($slug = null) {
        $product = $this->huntingResponsitory->findBy('slug', $slug);
        $commissionHuting = $this->settingRepository->getValueByKey('commission_hunting');
        $listOfferItems = $this->productOfferResponsitory->findWhere(['hunting_id' => $product->id, 'status' => 'active']);
        return view('front.product.detail-hunting', compact('product', 'productReview', 'commissionHuting','listOfferItems'));
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
        $products = $this->productRepository->paginate(9);
        return view('front.product.list', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid()
    {
        $products = $this->productRepository->paginate(9);
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
        $product = $this->huntingResponsitory->findBy('slug', $slug);
        $price = $request->inputPrice;
        $comment = $request->textareaComment;
        $param = [
            'hunting_id' => $product->id,
            'user_id' => auth()->user()->id,
            'offer_price' => $price,
            'comment' => $comment,
            'status' => 'active'
        ];
        $hunting = $this->productOfferResponsitory->create($param);

        // Create Product Hunting Images
        if( $request->hasFile('inputPhotos') ){
            $productImages = $request->file('inputPhotos');
            foreach ($productImages as $file) {
                $path = $file->store('hunting_offer/galeries');
                $this->huntingImageResponsitory->create(['product_offers_id' => $hunting->id, 'image_path' => $path, 'image_name'=> $file->getClientOriginalName()]);
            }
        }

        return redirect()->back()->with('msgOk', 'You already swap for this product!');
    }

    public function acceptOffer(Request $request) {
        $id = $request->input('product_offer_id');
        $offer = $this->productOfferResponsitory->find($id);

        if( isset($request->payment) && $request->payment == 'paypal' ){
            $SECFields = array(
                'token' => '',                              // A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
                'maxamt' => $offer->offer_price,                      // The expected maximum total amount the order will be, including S&H and sales tax.
                'returnurl' => route('front.hunting.thankYou'),                            // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
                'cancelurl' => route('front.checkout.fail'),                            // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
            );

            // Basic array of survey choices.  Nothing but the values should go in here.
            $SurveyChoices = array('Yes', 'No');

            $Payments = array();
            $Payment = array(
                'amt' => $offer->offer_price,                             // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                'currencycode' => 'USD',                    // A three-character currency code.  Default is USD.
                'itemamt' => $offer->offer_price,                         // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
                'shippingamt' => 0,                     // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                'insuranceoptionoffered' => '',         // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
                'handlingamt' => '',                    // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
                'taxamt' => '0',                        // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
                'desc' => 'This is a test order.',                          // Description of items on the order.  127 char max.
                'custom' => '',                         // Free-form field for your own use.  256 char max.
                'invnum' => '',                         // Your own invoice or tracking number.  127 char max.
                'notifyurl' => '',                          // URL for receiving Instant Payment Notifications
                'shiptoname' => '',                     // Required if shipping is included.  Person's name associated with this address.  32 char max.
                'shiptostreet' => '',                   // Required if shipping is included.  First street address.  100 char max.
                'shiptostreet2' => '',                  // Second street address.  100 char max.
                'shiptocity' => '',                     // Required if shipping is included.  Name of city.  40 char max.
                'shiptostate' => '',                    // Required if shipping is included.  Name of state or province.  40 char max.
                'shiptozip' => '',                      // Required if shipping is included.  Postal code of shipping address.  20 char max.
                'shiptocountry' => '',                  // Required if shipping is included.  Country code of shipping address.  2 char max.
                'shiptophonenum' => '',                 // Phone number for shipping address.  20 char max.
                'notetext' => 'This is a test note before ever having left the web site.',                      // Note to the merchant.  255 char max.
                'allowedpaymentmethod' => '',           // The payment method type.  Specify the value InstantPaymentOnly.
                'paymentaction' => 'Sale',                  // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
                'paymentrequestid' => '',               // A unique identifier of the specific payment request, which is required for parallel payments.
                'sellerpaypalaccountid' => ''           // A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
            );

            $PaymentOrderItems = array();
            $Item = array(
                'name' => 'Hunting product',                           // Item name. 127 char max.
                'desc' => $offer->comment,                           // Item description. 127 char max.
                'amt' => $offer->offer_price,                               // Cost of item.
                'number' => 1,                           // Item number.  127 char max.
                'qty' => 1,
            );
            array_push($PaymentOrderItems, $Item);

            $Payment['order_items'] = $PaymentOrderItems;
            array_push($Payments, $Payment);

            $BuyerDetails = array(
                'buyerid' => '',                // The unique identifier provided by eBay for this buyer.  The value may or may not be the same as the username.  In the case of eBay, it is different.  Char max 255.
                'buyerusername' => '',          // The username of the marketplace site.
                'buyerregistrationdate' => ''   // The registration of the buyer with the marketplace.
            );

            // For shipping options we create an array of all shipping choices similar to how order items works.
            $ShippingOptions = array();
            $Option = array(
                'l_shippingoptionisdefault' => '',              // Shipping option.  Required if specifying the Callback URL.  true or false.  Must be only 1 default!
                'l_shippingoptionname' => '',                   // Shipping option name.  Required if specifying the Callback URL.  50 character max.
                'l_shippingoptionlabel' => '',                  // Shipping option label.  Required if specifying the Callback URL.  50 character max.
                'l_shippingoptionamount' => ''                  // Shipping option amount.  Required if specifying the Callback URL.
            );
            array_push($ShippingOptions, $Option);

            $BillingAgreements = array();
            $Item = array(
                'l_billingtype' => 'MerchantInitiatedBilling',                          // Required.  Type of billing agreement.  For recurring payments it must be RecurringPayments.  You can specify up to ten billing agreements.  For reference transactions, this field must be either:  MerchantInitiatedBilling, or MerchantInitiatedBillingSingleSource
                'l_billingagreementdescription' => 'Billing Agreement',             // Required for recurring payments.  Description of goods or services associated with the billing agreement.
                'l_paymenttype' => 'Any',                           // Specifies the type of PayPal payment you require for the billing agreement.  Any or IntantOnly
                'l_billingagreementcustom' => ''                    // Custom annotation field for your own use.  256 char max.
            );
            array_push($BillingAgreements, $Item);

            $PayPalRequest = array(
                'SECFields' => $SECFields,
                'SurveyChoices' => $SurveyChoices,
                'BillingAgreements' => $BillingAgreements,
                'Payments' => $Payments
            );

            $data = $this->PayPal->SetExpressCheckout($PayPalRequest);

            $request->session('SetExpressCheckoutResult', $data);

            Session::put('offer_id',$id);

            return redirect($data['REDIRECTURL']);
        }elseif( isset($request->payment) && $request->payment == 'stripe' ) {
            // Payment method stripe
            $secret = !empty( $this->settingRepository->getValueByKey('stripe_secret') ) ? $this->settingRepository->getValueByKey('stripe_secret') : 'sk_test_NZVqZ3MEZvrySS5CEEHJkiO4';
            $stripe = Stripe::make($secret);
            try {
                $token = $stripe->tokens()->create([
                        'card' => [
                        'number'    => $request->input('card_no'),
                        'exp_year' => $request->input('ccExpiryYear'),
                        'exp_month' => $request->input('ccExpiryMonth'),
                        'cvc'       => $request->input('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('front.product.huntingdetail');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $offer->offer_price,
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {

                    $param['status'] = 'accept';
                    $this->productOfferResponsitory->update($param, $offer->id);
                    $this->huntingResponsitory->update($param, $offer->hunting_id);
                    Mail::to($offer->user->email)->send(new HuntingSuccess());

                    return view('front.ecommerce.hunting-thankyou');
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    return redirect()->route('front.product.huntingdetail',$offer->hunting->slug);
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('front.product.huntingdetail',$offer->hunting->slug);
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('front.product.huntingdetail',$offer->hunting->slug);
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('front.product.huntingdetail',$offer->hunting->slug);
            }
        }
    }

    public function rejectOffer(Request $request, $id) {
        $param['status'] = 'reject';
        $this->productOfferResponsitory->update($param, $id);
        return redirect()->back()->with('msgOk', 'Reject product success!');
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

    public function showHuntingThankYou(Request $request) {
        $offer = $this->productOfferResponsitory->find(Session::get('offer_id'));

        $GECDResult = $this->PayPal->GetExpressCheckoutDetails($request->token);

        $DECPFields = array(
            'token' => $request->token,
            'payerid' => $GECDResult['PAYERID']
        );

        $Payments = array();
        $Payment = array(
            'amt' => $offer->offer_price,                          // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
            'currencycode' => 'USD',                    // A three-character currency code.  Default is USD.
            'itemamt' => $offer->offer_price,                       // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
            'shippingamt' => 0,                   // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
            'insuranceoptionoffered' => '',         // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
            'handlingamt' => '',                    // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
            'taxamt' => '0',                         // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
            'desc' => 'This is a test order.',                          // Description of items on the order.  127 char max.
            'custom' => '',                         // Free-form field for your own use.  256 char max.
            'invnum' => '',                         // Your own invoice or tracking number.  127 char max.
            'notifyurl' => '',                          // URL for receiving Instant Payment Notifications
            'shiptoname' => '',                     // Required if shipping is included.  Person's name associated with this address.  32 char max.
            'shiptostreet' => '',                   // Required if shipping is included.  First street address.  100 char max.
            'shiptostreet2' => '',                  // Second street address.  100 char max.
            'shiptocity' => '',                     // Required if shipping is included.  Name of city.  40 char max.
            'shiptostate' => '',                    // Required if shipping is included.  Name of state or province.  40 char max.
            'shiptozip' => '',                      // Required if shipping is included.  Postal code of shipping address.  20 char max.
            'shiptocountry' => '',                  // Required if shipping is included.  Country code of shipping address.  2 char max.
            'shiptophonenum' => '',                 // Phone number for shipping address.  20 char max.
            'notetext' => 'This is a test note before ever having left the web site.',                      // Note to the merchant.  255 char max.
            'allowedpaymentmethod' => '',           // The payment method type.  Specify the value InstantPaymentOnly.
            'paymentaction' => 'Sale',                  // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
            'paymentrequestid' => '',               // A unique identifier of the specific payment request, which is required for parallel payments.
            'sellerpaypalaccountid' => ''           // A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
        );

        $PaymentOrderItems = array();
        $Item = array(
            'name' => 'Hunting product',                           // Item name. 127 char max.
            'desc' => $offer->comment,                           // Item description. 127 char max.
            'amt' => $offer->offer_price,                               // Cost of item.
            'number' => 1,                           // Item number.  127 char max.
            'qty' => 1,
        );
        array_push($PaymentOrderItems, $Item);

        $Payment['order_items'] = $PaymentOrderItems;
        array_push($Payments, $Payment);

        $PayPalRequest = array(
           'DECPFields' => $DECPFields,
           'Payments' => $Payments
        );

        $data = $this->PayPal->DoExpressCheckoutPayment($PayPalRequest);
        if(isset($data['ACK']) && $data['ACK'] == 'Success') {
            $param['status'] = 'accept';
            $this->productOfferResponsitory->update($param, $offer->id);
            $this->huntingResponsitory->update($param, $offer->hunting_id);
            Mail::to($offer->user->email)->send(new HuntingSuccess());
        }
        session()->forget('SetExpressCheckoutResult');
        session()->forget('offer_id');
        session()->forget('price');
        return view('front.ecommerce.checkout-thankyou', compact('data'));
    }

    /**
     * [counter description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function counter(Request $request) {
        $price_counter = $request->input('counter_price');
        $id = $request->input('id_offer');
        $param = [
            'product_offer_id' => $id,
            'key' => 'counter_price',
            'value' => $price_counter
        ];
        $counter = $this->productOfferMetaResponsitory->findWhere(['product_offer_id' => $id, 'key' => 'counter_price'])->first();
        if( $counter ) {
            $counter->value = $price_counter;
            $counter->update();
        }else{
            $this->productOfferMetaResponsitory->create($param);
        }
        return redirect()->back()->with('alert-success', 'Create counter offer success!');
    }

    public function counterNext(Request $request) {
        $id = $request->input('id_offer');
        $param['offer_price'] = $request->input('counter_price');
        $this->productOfferResponsitory->update($param, $id);
        $this->productOfferMetaResponsitory->deleteProductOfferMetaById($id);
        return redirect()->back()->with('alert-success', 'Update price hunting success');
    }

    /**
     * [acceptCounter description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function acceptCounter(Request $request, $id) {
        $price = $this->productOfferMetaResponsitory->findWhere(['product_offer_id' => $id])->first()->value;
        $param['offer_price'] = $price;
        $this->productOfferResponsitory->update($param, $id);
        return redirect()->back()->with('alert-success', 'Update price hunting success');
    }

    /**
     * [deniCounter description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function deniCounter(Request $request, $id) {
        $this->productOfferMetaResponsitory->deleteProductOfferMetaById($id);
        return redirect()->back()->with('alert-success', 'Deni price counter success');
    }

    public function getProductVariation(Request $request) {
        if( $request->ajax() ) {
            $id = $request->id;
            $product_variation = $this->productVariationResponsitory->find($id);
            return response()->json($product_variation);
        }
    }

    public function postProductVariationInfo(Request $request, $product_id = 0){
        if( isset( $request->attrs ) ){
            $product = $this->productVariationResponsitory->getProductAttribute($product_id, $request->attrs);
            return response()->json($product, 200);
        }else{
            return response()->json(['id' => 0, 'data' => null], 404);
        }
    }
}
