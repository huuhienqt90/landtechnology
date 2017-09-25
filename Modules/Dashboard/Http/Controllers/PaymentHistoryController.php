<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\PaymentHistoryResponsitory;
use App\Repositories\OrderResponsitory;
use Hamilton\PayPal\Api\Payout;
use Hamilton\PayPal\Auth\OAuthTokenCredential;
use Hamilton\PayPal\Rest\ApiContext;
use Hamilton\PayPal\Api\PayoutSenderBatchHeader;
use Hamilton\PayPal\Api\PayoutItem;
use Hamilton\PayPal\Api\Currency;
use App\Repositories\UserResponsitory;
use Config;
class PaymentHistoryController extends Controller
{
    private $paymentHistoryResponsitory;
    private $orderResponsitory;
    private $apiContext;
    private $userResponsitory;

    public function __construct(PaymentHistoryResponsitory $paymentHistoryResponsitory,
                                OrderResponsitory $orderResponsitory,
                                UserResponsitory $userResponsitory)
    {
        $this->paymentHistoryResponsitory = $paymentHistoryResponsitory;
        $this->orderResponsitory = $orderResponsitory;
        $this->userResponsitory = $userResponsitory;

        $client_id = 'AbFe_YLDLF6VnRSFtD0fZHI9YuNNWMY3eOx6Dg3LNXwusLZyI7WjpiSqTBc9Kk0rr6xil_u1Wt0Y49SP';
        $secret = 'EAbob2VpTck0P2wHNJarzxfL82mkUcTYhnof3bLRTd43UM7Ffiqzr7BL8VZy8W-Ly-XPZ-zxeyvZ-kfg';
        $this->apiContext = new ApiContext(new OAuthTokenCredential($client_id, $secret));
        $this->apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $histories = $this->orderResponsitory->all();
        return view('dashboard::payment-history.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::payment-history.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::payment-history.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $payments = $this->paymentHistoryResponsitory->findAllBy('order_id', $id);
        return view('dashboard::payment-history.edit', compact('payments'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function paid(Request $request, $id)
    {
        $order = $this->paymentHistoryResponsitory->find($id);
        $user = $this->userResponsitory->find($order->seller_id);
        if($user->email_paypal == null) {
            return redirect()->back()->with('msg','User have not email paypal!');
        }
        $senderBatchHeader = new PayoutSenderBatchHeader();
        
        $senderBatchHeader->setSenderBatchId(uniqid())->setEmailSubject("You have a Payout!");        // #### Sender Item
        // Please note that if you are using single payout with sync mode, you can only pass one Item in the request
        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver($user->email_paypal)
            ->setSenderItemId($order->order_id)
            ->setAmount(new Currency('{
                        "value":'.$order->price_after_fee.',
                        "currency":"USD"
                    }'));
        $payouts = new Payout();
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);
        // For Sample Purposes Only.
        $request = clone $payouts;
        // ### Create Payout
        try {
            $output = $payouts->createSynchronous($this->apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
         ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
        return $output;
    }
}
