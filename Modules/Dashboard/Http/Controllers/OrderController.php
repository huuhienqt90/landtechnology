<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\OrderResponsitory;
use App\Repositories\OrderMetaResponsitory;
use App\Repositories\OrderProductResponsitory;
use App\Repositories\ProductResponsitory;
use App\Repositories\UserResponsitory;
use Modules\Dashboard\Http\Requests\OrderStoreRequest;
use Modules\Dashboard\Http\Requests\OrderUpdateRequest;

class OrderController extends DashboardController
{
    protected $menuActive = 'ecommerce';
    protected $subMenuActive = 'order';

    protected $orderResponsitory;
    protected $orderMetaResponsitory;
    protected $orderProductResponsitory;
    protected $productResponsitory;
    protected $userResponsitory;

    public function __construct(OrderResponsitory $orderResponsitory,
                                OrderMetaResponsitory $orderMetaResponsitory,
                                OrderProductResponsitory $orderProductResponsitory,
                                ProductResponsitory $productResponsitory,
                                UserResponsitory $userResponsitory)
    {
        $this->orderResponsitory = $orderResponsitory;
        $this->orderMetaResponsitory = $orderMetaResponsitory;
        $this->orderProductResponsitory = $orderProductResponsitory;
        $this->productResponsitory = $productResponsitory;
        $this->userResponsitory = $userResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $orders = $this->orderResponsitory->all();
        return $this->viewDashboard('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $order = $this->orderResponsitory;
        return $this->viewDashboard('order.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(OrderStoreRequest $request)
    {
        $param = [];
        $param['status'] = $request->order_status;
        if( $request->customer_user != null ) {
            $param['customer'] = $request->customer_user;
        }else{
            $param['customer'] = 0;
        }
        $order = $this->orderResponsitory->create($param);

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
        if( $request->product_id != null ) {
            $product_ids = $request->product_id;
            $price = 0;
            foreach($product_ids as $id) {
                $product = $this->productResponsitory->find($id);
                if( $product->sale_price != 0) {
                    $price = $product->sale_price;
                }else{
                    $price = $product->original_price;
                }
                $paramOrderProd = [
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'variation_id' => 0,
                    'price' => $price,
                    'tax' => 0,
                    'qty' => $request->qtyShow[$id],
                    'total' => $price*$request->qtyShow[$id]
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
            $tax += $product->tax;
        }
        $param = [
            'total' => $total,
            'tax' => $tax
        ];
        $this->orderResponsitory->update($param, $order->id);

        if( isset( $request->orderNote) ){
            $orderNote = serialize($request->orderNote);
            $this->orderMetaResponsitory->create(['key' => 'orderNote', 'value' => $orderNote, 'order_id' => $order->id]);
        }

        return redirect(route('dashboard.order.index'))->with('alert-success', 'Create order success!');
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
        $order = $this->orderResponsitory->find($id);
        $arUser = [];
        if($order->customer) {
            $user = $this->userResponsitory->find($order->customer);
            $arUser = [$user->id => $user->username];
        }
        $orderMetas = $this->orderMetaResponsitory->findAllBy('order_id',$id);
        $order_products = $this->orderProductResponsitory->findALlBy('order_id', $id);
        return $this->viewDashboard('order.edit', compact('order','arUser','orderMetas','order_products'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        $param = [];
        $param['status'] = $request->order_status;
        if( $request->customer_user != null ) {
            $param['customer'] = $request->customer_user;
        }else{
            $param['customer'] = 0;
        }
        $this->orderResponsitory->update($param, $id);

        $this->orderMetaResponsitory->deleteOrderMeta($id);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingFirstName',
            'value' => $request->billingFirstName
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingLastName',
            'value' => $request->billingLastName
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingCompany',
            'value' => $request->billingCompany
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingAddress1',
            'value' => $request->billingAddress1
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingAddress2',
            'value' => $request->billingAddress2
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingPostCode',
            'value' => $request->billingPostCode
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingCity',
            'value' => $request->billingCity
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingPhone',
            'value' => $request->billingPhone
        ];
        $this->orderMetaResponsitory->create($paramBill);
        $paramBill = [
            'order_id' => $id,
            'key' => 'billingEmail',
            'value' => $request->billingEmail
        ];
        $this->orderMetaResponsitory->create($paramBill);

        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingFirstName',
            'value' => $request->shippingFirstName
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingLastName',
            'value' => $request->shippingLastName
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingCompany',
            'value' => $request->shippingCompany
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingAddress1',
            'value' => $request->shippingAddress1
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingAddress2',
            'value' => $request->shippingAddress2
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingPostCode',
            'value' => $request->shippingPostCode
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingCity',
            'value' => $request->shippingCity
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingPhone',
            'value' => $request->shippingPhone
        ];
        $this->orderMetaResponsitory->create($paramShip);
        $paramShip = [
            'order_id' => $id,
            'key' => 'shippingEmail',
            'value' => $request->shippingEmail
        ];
        $this->orderMetaResponsitory->create($paramShip);

        // Get total for orders
        $products = $this->orderProductResponsitory->findALlBy('order_id',$id);
        $total = 0;
        $subtotal = 0;
        $tax = 0;
        foreach($products as $product) {
            $total += $product->total;
            $tax += $product->tax;
        }
        $param = [
            'total' => $total
        ];
        $this->orderResponsitory->update($param, $id);

        if( isset( $request->orderNote) ){
            $orderNote = serialize($request->orderNote);
            $this->orderMetaResponsitory->create(['key' => 'orderNote', 'value' => $orderNote, 'order_id' => $id]);
        }

        return redirect(route('dashboard.order.index'))->with('alert-success', 'Update order success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->orderProductResponsitory->deleteOrderProduct($id);
        $this->orderMetaResponsitory->deleteOrderMeta($id);
        $this->orderResponsitory->delete($id);
        return redirect(route('dashboard.order.index'))->with('alert-success', 'Delete order success!');
    }
}
