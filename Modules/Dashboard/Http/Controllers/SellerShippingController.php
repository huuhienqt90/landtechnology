<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\SellerShippingResponsitory;
use Modules\Dashboard\Http\Requests\SellerShippingUpdateRequest;
use Modules\Dashboard\Http\Requests\SellerShippingStoreRequest;

class SellerShippingController extends DashboardController
{
    protected $menuActive = 'products';
    protected $subMenuActive = 'seller-shipping';

    protected $sellerShippingResponsitory;
    public function __construct(SellerShippingResponsitory $sellerShippingResponsitory){
        $this->sellerShippingResponsitory = $sellerShippingResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sellerShippings = $this->sellerShippingResponsitory->getSellerShippingsByUser(auth()->user()->id, 20);
        return $this->viewDashboard('seller-shipping.index', compact('sellerShippings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $sellerShipping = $this->sellerShippingResponsitory;
        return $this->viewDashboard('seller-shipping.create', compact('sellerShipping'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SellerShippingStoreRequest $request)
    {
        $create = ['seller_id' => auth()->user()->id, 'from_country' => $request->from_country, 'to_country' => $request->to_country, 'cost' => $request->cost];
        $this->sellerShippingResponsitory->create($create);
        return redirect(route('dashboard.seller-shipping.index'))->with('alert-success', 'Create seller shipping sucess!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return $this->viewDashboard('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $sellerShipping = $this->sellerShippingResponsitory->find($id);
        return $this->viewDashboard('seller-shipping.edit', compact('sellerShipping'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(SellerShippingUpdateRequest $request, $id)
    {
        $update = ['from_country' => $request->from_country, 'to_country' => $request->to_country, 'cost' => $request->cost];
        $this->sellerShippingResponsitory->update($update, $id);
        return redirect(route('dashboard.seller-shipping.index'))->with('alert-success', 'Update seller shipping sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->sellerShippingResponsitory->find($id);
        $arItem->delete();
        return redirect(route('dashboard.seller-shipping.index'))->with('alert-success', 'Delete seller shipping success');
    }
}
