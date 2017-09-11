<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\PostCheckoutRequest;
use App\Http\Requests\PostToCartRequest;
use App\Http\Controllers\Controller;
use Cart;
use App\PaymentMethod\PayPal\PayPal;
use App\Repositories\SettingRepository;
use App\Repositories\ProductResponsitory;

class CartController extends Controller
{
    private $PayPal;
    private $productRepository;
    private $settingRepository;
    public function __construct(ProductResponsitory $productRepository, SettingRepository $settingRepository){
        $this->productRepository = $productRepository;
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
        if( isset($request->paymentMethod) && $request->paymentMethod == 'paypal'){
            $SECFields = array(
                'token' => '',                              // A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
                'maxamt' => Cart::total(),                      // The expected maximum total amount the order will be, including S&H and sales tax.
                'returnurl' => route('front.checkout.thankYou'),                            // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
                'cancelurl' => route('front.checkout.fail'),                            // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
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
                    'name' => $row->name,                           // Item name. 127 char max.
                    'desc' => $row->name,                           // Item description. 127 char max.
                    'amt' => $row->price,                               // Cost of item.
                    'number' => $row->id,                           // Item number.  127 char max.
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
            $request->session('SetExpressCheckoutResult', $data);
            return redirect($data['REDIRECTURL']);
        }
    }
}