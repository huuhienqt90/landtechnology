<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\PaymentHistoryResponsitory;
use App\Repositories\OrderResponsitory;
use Hamilton\PayPal\Api\Payout;
use Hamilton\PayPal\Rest\ApiContext;
use Hamilton\PayPal\Api\PayoutSenderBatchHeader;
use Hamilton\PayPal\Api\PayoutItem;
use Hamilton\PayPal\Api\Currency;
use Hamilton\PayPal\Common\ResultPrinter;
use App\Repositories\UserResponsitory;
use Config;
class PaymentHistoryController extends DashboardController
{
    protected $menuActive = 'ecommerce';
    protected $subMenuActive = 'payment-history';

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
        $this->apiContext = new ApiContext();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $histories = $this->orderResponsitory->all();
        return $this->viewDashboard('payment-history.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return $this->viewDashboard('payment-history.create');
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
        return $this->viewDashboard('payment-history.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $payments = $this->paymentHistoryResponsitory->findAllBy('order_id', $id);
        return $this->viewDashboard('payment-history.edit', compact('payments'));
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

    public function paid($id)
    {
        $order = $this->paymentHistoryResponsitory->find($id);
        $user = $this->userResponsitory->find($order->seller_id);
        if($user->isSuperUser()) {
            return redirect()->back()->with('alert-danger','This product post by admin so you can not pay for your sefl');
        }

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
