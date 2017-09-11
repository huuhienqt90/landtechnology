<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentMethod\PayPal\PayPal;
use App\Repositories\SettingRepository;
use App\Repositories\ProductResponsitory;
use Cart;

class OrderController extends Controller
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
     * Show checkout thank you page
     */
    public function showCheckoutThankYou(Request $request){
        $GECDResult = $this->PayPal->GetExpressCheckoutDetails($request->token);

        $DECPFields = array(
            'token' => $request->token,
            'payerid' => $GECDResult['PAYERID']
        );

        $Payments = array();
        $Payment = array(
            'amt' => Cart::total(),                          // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
            'currencycode' => 'USD',                    // A three-character currency code.  Default is USD.
            'itemamt' => Cart::total(),                       // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
            'shippingamt' => 0,                   // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
            'insuranceoptionoffered' => '',         // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
            'handlingamt' => '',                    // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
            'taxamt' => Cart::tax(),                         // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
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
                'qty' => $row->qty
            );
            array_push($PaymentOrderItems, $Item);
        endforeach;

        $Payment['order_items'] = $PaymentOrderItems;
        array_push($Payments, $Payment);

        $PayPalRequest = array(
           'DECPFields' => $DECPFields,
           'Payments' => $Payments
        );

        $data = $this->PayPal->DoExpressCheckoutPayment($PayPalRequest);
        Cart::destroy();
        session()->forget('SetExpressCheckoutResult');
        return view('front.ecommerce.checkout-thankyou', compact('data'));
    }

    /**
     * Show checkout fail page
     */
    public function showCheckoutFail(){
        return view('front.404');
    }
}
