<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\PaymentHistoryResponsitory;
use App\Repositories\OrderResponsitory;

class PaymentHistoryController extends Controller
{
    private $paymentHistoryResponsitory;
    private $orderResponsitory;

    public function __construct(PaymentHistoryResponsitory $paymentHistoryResponsitory,
                                OrderResponsitory $orderResponsitory)
    {
        $this->paymentHistoryResponsitory = $paymentHistoryResponsitory;
        $this->orderResponsitory = $orderResponsitory;
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
}
