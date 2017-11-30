<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductCategoryResponsitory;
use App\Repositories\ProductImageResponsitory;
use App\Repositories\ProductAttributeResponsitory;
use App\Repositories\ProductResponsitory;
use App\Repositories\BrandResponsitory;
use App\Repositories\ProductBrandResponsitory;
use App\Repositories\CategoryResponsitory;
use App\Repositories\SellerShippingResponsitory;
use App\Repositories\SellTypeResponsitory;
use App\Repositories\UserResponsitory;
use App\Repositories\AttributeResponsitory;
use App\Http\Requests\SwappingRequest;
use App\Http\Requests\SwappingUpdateRequest;
use App\Repositories\SettingRepository;
use App\Repositories\SwapItemResponsitory;
use App\Repositories\TagReponsitory;
use App\Repositories\ProductTagResponsitory;
use Hamilton\PayPal\PayPal;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Session;
use App\Models\ProductBrand;

class SwappingController extends Controller
{
    protected $productResponsitory;
    protected $userResponsitory;
    protected $productCategoryResponsitory;
    protected $productImageResponsitory;
    protected $productAttributeResponsitory;
    protected $categoryResponsitory;
    protected $attributeResponsitory;
    protected $settingRepository;
    protected $swapItemResponsitory;
    protected $productBrandResponsitory;
    protected $tagReponsitory;
    protected $productTagResponsitory;
    private $PayPal;

    public function __construct(ProductResponsitory $productResponsitory,
                                ProductAttributeResponsitory $productAttributeResponsitory,
                                ProductCategoryResponsitory $productCategoryResponsitory,
                                ProductImageResponsitory $productImageResponsitory,
                                UserResponsitory $userResponsitory,
                                CategoryResponsitory $categoryResponsitory,
                                SellerShippingResponsitory $sellerShippingResponsitory,
                                SellTypeResponsitory $sellTypeResponsitory,
                                BrandResponsitory $brandResponsitory,
                                AttributeResponsitory $attributeResponsitory,
                                SettingRepository $settingRepository,
                                SwapItemResponsitory $swapItemResponsitory,
                                ProductBrandResponsitory $productBrandResponsitory,
                                TagReponsitory $tagReponsitory,
                                ProductTagResponsitory $productTagResponsitory)
    {
        $this->productResponsitory = $productResponsitory;
        $this->productAttributeResponsitory = $productAttributeResponsitory;
        $this->productCategoryResponsitory = $productCategoryResponsitory;
        $this->productImageResponsitory = $productImageResponsitory;
        $this->categoryResponsitory         = $categoryResponsitory;
        $this->brandResponsitory            = $brandResponsitory;
        $this->sellerShippingResponsitory   = $sellerShippingResponsitory;
        $this->sellTypeResponsitory         = $sellTypeResponsitory;
        $this->userResponsitory             = $userResponsitory;
        $this->attributeResponsitory        = $attributeResponsitory;
        $this->settingRepository            = $settingRepository;
        $this->swapItemResponsitory         = $swapItemResponsitory;
        $this->productBrandResponsitory     = $productBrandResponsitory;
        $this->tagReponsitory               = $tagReponsitory;
        $this->productTagResponsitory       = $productTagResponsitory;
        $this->middleware('check.auth:seller');

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
    public function index(Request $request)
    {
        $oldCommissionSwap = $this->settingRepository->getValueByKey('commission_swap');

        $GECDResult = $this->PayPal->GetExpressCheckoutDetails($request->token);

        if( $request->token != null ) {
            $GECDResult = $this->PayPal->GetExpressCheckoutDetails($request->token);
            $DECPFields = array(
                'token' => $request->token,
                'payerid' => $GECDResult['PAYERID']
            );

            $Payments = array();
            $Payment = array(
                'amt' => $oldCommissionSwap,                          // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                'currencycode' => 'USD',                    // A three-character currency code.  Default is USD.
                'itemamt' => $oldCommissionSwap,                       // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
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
                'name' => 'Swap fee',                           // Item name. 127 char max.
                'desc' => 'Swap fee',                           // Item description. 127 char max.
                'amt' => $oldCommissionSwap,                               // Cost of item.
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
            if($data['ACK'] == 'Success') {
                $param['status'] = 'active';
                $result = $this->productResponsitory->update($param, Session::get('product_id'));
            }
            session()->forget('SetExpressCheckoutResult');
            Session::forget('product_id');
        }
        $products = $this->productResponsitory->getSwapingProducts(auth()->user()->id);

        return view('front.swapping.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = $this->brandResponsitory->getArrayNameBrands();
        $categories = $this->categoryResponsitory->getArrayNameCategories();
        $allCategories = $this->categoryResponsitory->all();
        $selltypes = $this->sellTypeResponsitory->getArrayNameSellTypes();

        $attrs = $this->attributeResponsitory->all();
        $attrArr = [];
        foreach($attrs as $attr){
            $attrArr[$attr->id] = $attr->name;
        }
        $oldCommissionSwap = $this->settingRepository->getValueByKey('commission_swap');
        $tags = $this->tagReponsitory->all();
        $arrTags = [];
        foreach( $tags as $tag ) {
            $arrTags[$tag->id] = $tag->name;
        }

        return view('front.swapping.create', compact('brands','arrTags','categories','selltypes','allCategories','attrArr','oldCommissionSwap'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SwappingRequest $request)
    {
        $oldCommissionSwap = $this->settingRepository->getValueByKey('commission_swap');

        $param = $request->only(['name','slug','description','description_short','sell_type_id']);
        $param['sold_units'] = 0;
        $param['seller_id'] = auth()->user()->id;
        $param['status'] = 'Pending';
        $param['created_by'] = auth()->user()->id;
        $param['kind'] = 'swapping';
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('swapproduct/features');
            $param['feature_image'] = $path;
        }

        $result = $this->productResponsitory->create($param);

        // Create tags product
        if( $request->tags != null ) {
            foreach($request->tags as $tag) {
                if( !is_numeric($tag) ) {
                    $tagId = $this->tagReponsitory->create(['name' => $tag, 'slug' => str_slug($tag,'-')]);
                    $this->productTagResponsitory->create(['product_id' => $result->id,'tag_id' => $tagId->id]);
                }else{
                    $this->productTagResponsitory->create(['product_id' => $result->id,'tag_id' => $tag]);
                }
            }
        }

        // Create category product
        $this->productCategoryResponsitory->create(['product_id' => $result->id, 'category_id' => $request->category]);

        // Create brand product
        $this->productBrandResponsitory->create(['product_id' => $result->id, 'brand_id' => $request->product_brand]);

        // Create Product Images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('swapproduct/galeries');
                $this->productImageResponsitory->create(['product_id' => $result->id, 'image_path' => $path, 'image_name'=> $file->getClientOriginalName()]);
            }
        }

        if( isset($request->paymentMethod) && $request->paymentMethod == 'paypal' ){
            $SECFields = array(
                'token' => '',                              // A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
                'maxamt' => $oldCommissionSwap,                      // The expected maximum total amount the order will be, including S&H and sales tax.
                'returnurl' => route('swapping.index'),                            // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
                'cancelurl' => route('front.checkout.fail'),                            // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
            );

            // Basic array of survey choices.  Nothing but the values should go in here.
            $SurveyChoices = array('Yes', 'No');

            $Payments = array();
            $Payment = array(
                'amt' => $oldCommissionSwap,                             // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                'currencycode' => 'USD',                    // A three-character currency code.  Default is USD.
                'itemamt' => $oldCommissionSwap,                         // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
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
                'name' => 'Swap fee',                           // Item name. 127 char max.
                'desc' => 'Swap fee',                           // Item description. 127 char max.
                'amt' => $oldCommissionSwap,                               // Cost of item.
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
            Session::put('product_id',$result->id);

            return redirect($data['REDIRECTURL']);
        }elseif( isset($request->paymentMethod) && $request->paymentMethod == 'stripe' ) {
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
                    return redirect()->route('swapping.create');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request->input('amount'),
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {
                    
                    $param['status'] = 'active';
                    $this->productResponsitory->update($param, $result->id);
                    
                    return redirect(route('swapping.index'))->with('alert-success', 'Create swapping product success!');
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    return redirect()->route('swapping.create');
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('swapping.create');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('swapping.create');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('swapping.create');
            }
        }
        
        return redirect(route('swapping.index'))->with('alert-error', 'Error!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productResponsitory->find($id);
        $brands = $this->brandResponsitory->getArrayNameBrands();

        $categories = $this->categoryResponsitory->all();

        $selltypes = $this->sellTypeResponsitory->getArrayNameSellTypes();

        $productImages = $this->productImageResponsitory->findAllBy('product_id', $id);
        $productImageArr = [];
        if( $productImages && $productImages->count() ){
            foreach ($productImages as $productImage) {
                $productImageArr[$productImage->id] = $productImage->image_path;
            }
        }

        $productTags = $this->productTagResponsitory->findAllBy('product_id', $id);
        $arTagId = [];
        foreach( $productTags as $tag ) {
            $arTagId[] = $tag->tag_id;
        }

        $tags = $this->tagReponsitory->all();
        $arrTags = [];
        foreach( $tags as $tag ) {
            $arrTags[$tag->id] = $tag->name;
        }

        $productAttributesArr = [];
        $attributesArr = [];
        $productAttributes = $this->productAttributeResponsitory->findAllBy('product_id', $id);
        if( $productAttributes && $productAttributes->count() ){
            foreach( $productAttributes as $productAttribute ){
                $productAttributesArr[$productAttribute->attribute_id] = $productAttribute->attribute->name;
                $attributesArr[$productAttribute->id] = $productAttribute->value;
            }
        }

        $productCategories = $this->productCategoryResponsitory->findAllBy('product_id', $id);
        $productCategoryArr = [];
        if( $productCategories && $productCategories->count() ){
            foreach ($productCategories as $productCategory) {
                $productCategoryArr[$productCategory->category_id] = $productCategory->category_id;
            }
        }
        $product->category = $productCategoryArr;
        
        $product_brands = $this->productBrandResponsitory->findAllBy('product_id', $id);
        $arrProductBrands = [];
        foreach($product_brands as $item) {
            $arrProductBrands[$item->brand_id] = $item->brand_id;
        }
        $product->product_brand = $arrProductBrands;

        $attrs = $this->attributeResponsitory->all();
        $attrArr = $this->attributeResponsitory->all();

        $product->attribute = $productAttributesArr;

        return view('front.swapping.edit', compact('product','arrTags','arTagId','brands','categories','selltypes','productImages','attrArr','attributesArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SwappingUpdateRequest $request, $id)
    {
        $update = [
            'status' => 'active',
            'slug' => $request->slug,
            'name' => $request->name,
            'description_short' => $request->description_short,
            'description' => $request->description,
            'seller_id' => auth()->user()->id,
            'sell_type_id' => $request->sell_type_id,
        ];

        // Update feature image
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('swapproduct/features');
            $update['feature_image'] = $path;
        }
        $this->productResponsitory->update($update, $id);

        if( $request->tags != null ) {
            $this->productTagResponsitory->deleteByProductId($id);
            foreach($request->tags as $tag) {
                if( !is_numeric($tag) ) {
                    $tagId = $this->tagReponsitory->create(['name' => $tag, 'slug' => str_slug($tag,'-')]);
                    $this->productTagResponsitory->create(['product_id' => $id,'tag_id' => $tagId->id]);
                }else{
                    $this->productTagResponsitory->create(['product_id' => $id,'tag_id' => $tag]);
                }
            }
        }

        // Update product category
        $this->productCategoryResponsitory->deleteProductCategory($id);
        $this->productCategoryResponsitory->create(['product_id' => $id, 'category_id' => $request->category]);
        // Update product brand
        ProductBrand::where('product_id', $id)->delete();
        if( isset( $request->product_brand ) && $request->product_brand){
            ProductBrand::create(['product_id' => $id, 'brand_id' => $request->product_brand]);
        }
        // Update product images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('swapproduct/galeries');
                $this->productImageResponsitory->create(['product_id' => $id, 'image_path' => $path, 'image_name'=>$file->getClientOriginalName()]);
            }
        }
        return redirect(route('swapping.index'))->with('alert-success', 'Update swapping product success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_images = $this->productImageResponsitory->findAllBy('product_id', $id);
        if($product_images != null) {
            foreach($product_images as $image){
                \Storage::delete($image->image_path);
                $this->productImageResponsitory->delete($id);
            }
        }
        $this->productAttributeResponsitory->deleteProductAttribute($id);
        $product = $this->productResponsitory->find($id);
        \Storage::delete($product->feature_image);
        $this->productResponsitory->delete($id);
        return redirect(route('swapping.index'))->with('alert-success', 'Delete product success!');
    }

    public function listAccept()
    {
        $products = $this->swapItemResponsitory->getListSwapAccept(auth()->user()->id);

        return view('front.swapping.list-swap', compact('products'));
    }
}
