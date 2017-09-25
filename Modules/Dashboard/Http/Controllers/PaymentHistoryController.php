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
use Hamilton\PayPal\Common\ResultPrinter;
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

        $client_id = 'AZrF7au7DWcIKrKApaOzaVZq-8nd2CD3_adxF5lrmJEARxJVTsbSGXYalT53l8WVdygjmZzT6LJM2Hzs';
        $secret = 'EP8lLv8sWIMNqe3WrQ2gLXqIjhvsW-dX3hUDRLz2aEsQMfLfCftpCsEDK81Bu4PZxwUMq6u5pruzk2y-';
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
        $payouts = new Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");

        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver('testcustomerland@gmail.com')
            ->setAmount(new Currency('{
                                "value":"200",
                                "currency":"USD"
                            }'));
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);
            // For Sample Purposes Only.
        $request = clone $payouts;
        // ### Create Payout
        try {
            $output = $payouts->createSynchronous($this->apiContext);
        } catch (\Exception $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return view('dashboard::payment-history.index', compact('histories'));
        }
        if( count( $output->getItems()[0]->getErrors() ) && !empty( $output->getItems()[0]->getErrors()->getMessage() ) ){
            session()->flash('alert-danger', $output->getItems()[0]->getErrors()->getMessage());
            return view('dashboard::payment-history.index', compact('histories'));
        }else{
            session()->flash('alert-success', 'Send payout success');
            return view('dashboard::payment-history.index', compact('histories'));
        }

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
            return redirect()->back()->with('alert-danger','User have not email paypal!');
        }
        $senderBatchHeader = new PayoutSenderBatchHeader();

        $senderBatchHeader->setSenderBatchId(uniqid())->setEmailSubject("Pay for your product sold!!");
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
        } catch (\Exception $ex) {
            return redirect()->back()->with('alert-danger', $ex->getMessage());
        }
        if( count( $output->getItems()[0]->getErrors() ) && !empty( $output->getItems()[0]->getErrors()->getMessage() ) ){
            return redirect()->back()->with('alert-danger', $output->getItems()[0]->getErrors()->getMessage());
        }else{
            $this->paymentHistoryResponsitory->update(['status' => 'paid'], $id);
            return redirect()->back()->with('alert-success', 'Send payout success');
        }
    }
}
