<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\PaymentMethodResponsitory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PaymentMethodController extends Controller
{
    protected $paymentMethodResponsitory;
    public function __construct(PaymentMethodResponsitory $paymentMethodResponsitory)
    {
        $this->paymentMethodResponsitory = $paymentMethodResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::create');
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $paymentMethod = $this->paymentMethodResponsitory->find($id);
        $view = $paymentMethod->slug;
        return view('dashboard::payment-method.edit-'.$view);
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
