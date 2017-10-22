<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\PostCheckoutRequest;
use App\Http\Requests\PostToCartRequest;
use App\Http\Controllers\Controller;
use Cart;
use Auth;
use Hamilton\PayPal\PayPal;
use App\Repositories\SettingRepository;
use App\Repositories\ProductResponsitory;
use App\Repositories\OrderResponsitory;
use App\Repositories\OrderMetaResponsitory;
use App\Repositories\OrderProductResponsitory;
use App\Repositories\PaymentHistoryResponsitory;
use App\Repositories\ProductVariationResponsitory;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderProduct;

class CartController extends Controller
{
    private $PayPal;
    private $productRepository;
    private $settingRepository;
    private $orderResponsitory;
    private $orderMetaResponsitory;
    private $orderProductResponsitory;
    private $paymentHistoryResponsitory;
    private $productVariationResponsitory;

    public function __construct(ProductResponsitory $productRepository,
                                SettingRepository $settingRepository,
                                OrderResponsitory $orderResponsitory,
                                OrderMetaResponsitory $orderMetaResponsitory,
                                OrderProductResponsitory $orderProductResponsitory,
                                PaymentHistoryResponsitory $paymentHistoryResponsitory,
                                ProductVariationResponsitory $productVariationResponsitory)
    {
        $this->productRepository = $productRepository;
        $this->settingRepository = $settingRepository;
        $this->orderResponsitory = $orderResponsitory;
        $this->orderMetaResponsitory = $orderMetaResponsitory;
        $this->orderProductResponsitory = $orderProductResponsitory;
        $this->paymentHistoryResponsitory = $paymentHistoryResponsitory;
        $this->productVariationResponsitory = $productVariationResponsitory;

        $PayPalConfig = array(
            'Sandbox' =>  config('paypal.Sandbox'),
            'APIUsername' => !empty( $this->settingRepository->getValueByKey('APIUsername') ) ? $this->settingRepository->getValueByKey('APIUsername') : config('paypal.APIUsername'),
            'APIPassword' => !empty( $this->settingRepository->getValueByKey('APIPassword') ) ? $this->settingRepository->getValueByKey('APIPassword') : config('paypal.APIPassword'),
            'APISignature' => !empty( $this->settingRepository->getValueByKey('APISignature') ) ? $this->settingRepository->getValueByKey('APISignature') : config('paypal.APISignature')
        );
        $this->PayPal = new PayPal($PayPalConfig);
    }
    /**
     * Add a product to cart
     */
    public function addToCart($id = 0, $quantity = 1, $options = [], $type = 'redirect'){
        $product = $this->productRepository->find($id);
        $cart = Cart::add($id, $product->name, $quantity, $product->getPriceNumber(), $options);
        if( $type == 'redirect'){
            return redirect()->back()->with('alert-success', 'Add product '.$product->name.' success');
        }else{
            return response()->json($cart);
        }
    }

    /**
     * Add a product to cart in product detail page
     */
    public function postToCart(PostToCartRequest $request, $id = 0){
        $product = $this->productRepository->find($id);
        Cart::add($id, $product->name, $request->quantity, $product->getPriceNumber());
        return redirect()->back()->with('alert-success', 'Add product '.$product->name.' success');
    }

    /**
     * Add a product to cart in product detail page by ajax
     */
    public function addToCartAjax(Request $request){
        if( $request->ajax() ) {
            $idVar = $request->idVar;
            $qty = $request->qty;
            $id = $request->id;
            $product_variation = $this->productVariationResponsitory->find($idVar);
            $product = $this->productRepository->find($id);
            $price = !$product_variation->sale_price ? $product_variation->sale_price : $product_variation->price;
            Cart::add($id, $product->name, $qty, $price);
            return response()->json(true);
        }
    }

    /**
     * Remove a product from cart
     */
    public function removeFromCart($id = 0){
        Cart::remove($id);
        return redirect()->back()->with('alert-success', 'Remove product in cart success');
    }

    /**
     * Add product to favorite
     */
    public function addToFavorite($id = 0, $quantity = 1, $options = [], $type = 'redirect'){
        $product = $this->productRepository->find($id);
        Cart::instance('wishlist')->add($id, $product->name, $quantity, $product->getPriceNumber(), $options);
        return redirect()->back()->with('alert-success', 'Add product to wish list success');
    }

    /**
     * Show cart page
     */
    public function showCart(){
        return view('front.ecommerce.cart');
    }

    /**
     * Show checkout page
     */
    public function showCheckout(){
        return view('front.ecommerce.checkout');
    }

    /**
     * Update or clear cart
     */
    public function updateCart(Request $request){
        switch ($request->cartType) {
            case 'update':
                if( count($request->quantity) && is_array($request->quantity)){
                    foreach($request->quantity as $rowId=>$qt){
                        Cart::update($rowId, $qt);
                    }
                }
                return redirect()->back()->with('alert-success', 'Update cart success!');
            case 'clear':
                Cart::destroy();
                return redirect()->back()->with('alert-success', 'Clear cart success!');

            default:
                return redirect()->back();
        }
    }

    /**
     * Processing order
     */
    public function postCheckout(PostCheckoutRequest $request){
        if( isset($request->paymentMethod) && $request->paymentMethod == 'paypal' ){
            $SECFields = array(
                'token' => '',
                'maxamt' => Cart::total(),
                'returnurl' => route('front.checkout.thankYou'),
                'cancelurl' => route('front.checkout.fail'),
            );

            // Basic array of survey choices.  Nothing but the values should go in here.
            $SurveyChoices = array('Yes', 'No');

            $Payments = array();
            $Payment = array(
                'amt' => Cart::total(),                             // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                'currencycode' => 'USD',                    // A three-character currency code.  Default is USD.
                'itemamt' => Cart::total(),                         // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
                'shippingamt' => 0,                     // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                'insuranceoptionoffered' => '',         // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
                'handlingamt' => '',                    // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
                'taxamt' => Cart::tax(),                        // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
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
            foreach(Cart::content() as $row):
                $Item = array(
                    'name' => $row->name,
                    'desc' => $row->name,
                    'amt' => $row->price,
                    'number' => $row->id,
                    'qty' => $row->qty,
                );
                array_push($PaymentOrderItems, $Item);
            endforeach;

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
            if(isset($data['ACK']) && $data['ACK'] == 'Success'){
                $request->session('SetExpressCheckoutResult', $data);
                $this->addOrder($request);
                return redirect($data['REDIRECTURL']);
            }else{
                return redirect()->back()->withInput($request->all())->with('alert-danger', $data['L_LONGMESSAGE0']);
            }

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
                    return redirect()->route('front.checkout');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request->input('amount'),
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {
                    // Create order
                    $this->addOrder($request);
                    // Create payment history
                    $orders = $this->orderProductResponsitory->findALlBy('order_id', \Session::get('orderId'));
                    foreach($orders as $order) {
                        $price = $order->product->sale_price?$order->product->sale_price:$order->product->original_price;
                        $fee = 0;
                        $commission = $this->paymentHistoryResponsitory->getCostCommission($order->product->category->category_id, 'seller');
                        if( $commission->type == 'percent' ) {
                            $fee = ($price*$commission->cost)/100;
                            if( $fee > $commission->maximum ) {
                                $fee = $commission->maximum;
                            }
                        }else{
                            $fee = $commission->cost;
                        }
                        $param = [
                            'seller_id' => $order->product->seller_id,
                            'order_id' => \Session::get('orderId'),
                            'customer' => \Session::get('fullname'),
                            'original_price' => $price,
                            'price_after_fee' => $price + $fee,
                            'price_fee' => $fee,
                            'note' => 'Payment Method Stripe, Seller'
                        ];
                        $this->paymentHistoryResponsitory->create($param);
                    }
                    Cart::destroy();
                    session()->forget('fullname');
                    session()->forget('orderId');
                    return view('front.ecommerce.checkout-thankyou', compact('charge'));
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    return redirect()->route('front.checkout');
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('front.checkout');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('front.checkout');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('front.checkout');
            }
        }
    }

    public function sendCart($email, $cart){
        if( !empty($email) && !empty($cart) ){
            Mail::to($email)->send(new OrderProduct($cart));
        }
    }

    public function addOrder($request) {
        // Create order
        $param = [];
        $param['status'] = 'pending';
        if( Auth::user() ) {
            $param['customer'] = Auth::user()->id;
        }else{
            $param['customer'] = 0;
        }
        $order = $this->orderResponsitory->create($param);
        \Session::put('orderId',$order->id);
        $fullname = $request->billingFirstName . ' ' . $request->billingLastName;
        \Session::put('fullname',$fullname);

        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingFirstName',
            'value' => $request->billingFirstName
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingLastName',
            'value' => $request->billingLastName
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingCompany',
            'value' => $request->billingCompany
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingAddress1',
            'value' => $request->billingAddress1
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingAddress2',
            'value' => $request->billingAddress2
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingPostCode',
            'value' => $request->billingPostCode
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingCity',
            'value' => $request->billingCity
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingPhone',
            'value' => $request->billingPhone
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $order->id,
            'key' => 'billingEmail',
            'value' => $request->billingEmail
        ];
        $this->orderMetaResponsitory->create($paramBill);

        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingFirstName',
            'value' => $request->shippingFirstName
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingLastName',
            'value' => $request->shippingLastName
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingCompany',
            'value' => $request->shippingCompany
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingAddress1',
            'value' => $request->shippingAddress1
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingAddress2',
            'value' => $request->shippingAddress2
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingPostCode',
            'value' => $request->shippingPostCode
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingCity',
            'value' => $request->shippingCity
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingPhone',
            'value' => $request->shippingPhone
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $order->id,
            'key' => 'shippingEmail',
            'value' => $request->shippingEmail
        ];
        $this->orderMetaResponsitory->create($paramShip);

        // Create order product
        if( Cart::content()->count() > 0 ) {
            $products = Cart::content();
            $price = 0;
            foreach($products as $item) {
                $paramOrderProd = [
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'variation_id' => 0,
                    'price' => $item->price,
                    'tax' => 0,
                    'qty' => $item->qty,
                    'subtotal' => $item->subtotal,
                    'total' => $item->total,
                ];
                $this->orderProductResponsitory->create($paramOrderProd);
            }
        }

        // Get total for orders
        $products = $this->orderProductResponsitory->findALlBy('order_id', $order->id);
        $total = 0;
        $subtotal = 0;
        $tax = 0;
        foreach($products as $product) {
            $total += $product->total;
            $subtotal += $product->subtotal;
            $tax += $product->tax;
        }
        $param = [
            'total' => $total,
            'subtotal' => $subtotal,
            'tax' => $tax
        ];
        $this->orderResponsitory->update($param, $order->id);

        if( isset( $request->orderNote) ){
            $orderNote = serialize($request->orderNote);
            $this->orderMetaResponsitory->create(['key' => 'orderNote', 'value' => $orderNote, 'order_id' => $order->id]);
        }
        $this->sendCart($request->shippingEmail, Cart::content());
    }
}
