<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\CouponResponsitory;
use App\Repositories\CategoryResponsitory;
use App\Repositories\ProductResponsitory;
use Modules\Dashboard\Http\Requests\CouponRequest;
use Modules\Dashboard\Http\Requests\CouponUpdateRequest;
use Auth;

class CouponController extends Controller
{
    protected $couponResponsitory;
    protected $categoryResponsitory;
    protected $productResponsitory;

    public function __construct(CouponResponsitory $couponResponsitory,
                                CategoryResponsitory $categoryResponsitory,
                                ProductResponsitory $productResponsitory)
    {
        $this->couponResponsitory = $couponResponsitory;
        $this->categoryResponsitory = $categoryResponsitory;
        $this->productResponsitory = $productResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $coupons = $this->couponResponsitory->all();
        return view('dashboard::coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $coupon = $this->couponResponsitory;
        $categories = $this->categoryResponsitory->getArrayNameCategories();
        return view('dashboard::coupons.create', compact('coupon','categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CouponRequest $request)
    {
        $param = $request->only(['code','description','type_discount','cost']);
        $param['create_by'] = Auth::user()->id;
        $param['minimum'] = $request->minimum != null ? $request->minimum : 0;
        $param['maximum'] = $request->maximum != null ? $request->maximum : 0;
        $param['limit_usage'] = $request->limit_usage != null ? $request->limit_usage : 0;
        $param['start_date'] = $request->start_date != null ? date('y-m-d', strtotime($request->start_date)) : null;
        $param['expiry_date'] = $request->expiry_date != null ? date('y-m-d', strtotime($request->expiry_date)) : null;
        $result = $this->couponResponsitory->create($param);

        $productArr = [];
        if( !empty($request->products) ){
            $products = $request->products;
            foreach($products as $id){
                $productArr[] = $id;
            }
        }
        $param['products_id'] = implode(',', $productArr);

        $cateArr = [];
        $categories = $request->categories;
        if( !empty($categories) ){
            foreach($categories as $id){
                $cateArr[] = $id;
            }
        }
        $param['categories_id'] = implode(',', $cateArr);
        $this->couponResponsitory->update($param, $result->id);
        return redirect(route('dashboard.coupon.index'))->with('alert-success', 'Create coupon success!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::coupons.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $coupon = $this->couponResponsitory->find($id);
        $categories = $this->categoryResponsitory->getArrayNameCategories();

        $cateArr = [];
        $cateArr = explode(',', $coupon->categories_id);

        $productArr = [];
        $productArr = explode(',', $coupon->products_id);

        $products = $this->productResponsitory->findAllBy('status','active');
        $prodArr = [];
        foreach($products as $product){
            $prodArr[$product->id] = $product->name;
        }

        return view('dashboard::coupons.edit', compact('coupon','categories','cateArr', 'productArr', 'prodArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CouponUpdateRequest $request, $id)
    {
        $param = $this->couponResponsitory->find($id);
        $param->code = $request->code;
        $param->description = $request->description;
        $param->type_discount = $request->type_discount;
        $param->cost = $request->cost;
        $param->update_by = Auth::user()->id;
        $param->minimum = $request->minimum != null ? $request->minimum : 0;
        $param->maximum = $request->maximum != null ? $request->maximum : 0;
        $param->limit_usage = $request->limit_usage != null ? $request->limit_usage : 0;
        $param->start_date = $request->start_date != null ? date('y-m-d', strtotime($request->start_date)) : null;
        $param->expiry_date = $request->expiry_date != null ? date('y-m-d', strtotime($request->expiry_date)) : null;

        $productArr = [];
        if( !empty($request->products) ){
            $products = $request->products;
            foreach($products as $id){
                $productArr[] = $id;
            }
        }
        $param->products_id = implode(',', $productArr);

        $cateArr = [];
        $categories = $request->categories;
        if( !empty($categories) ){
            foreach($categories as $id){
                $cateArr[] = $id;
            }
        }
        $param->categories_id = implode(',', $cateArr);
        $param->update();
        return redirect(route('dashboard.coupon.index'))->with('alert-success', 'Update coupon success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->couponResponsitory->delete($id);
        return redirect(route('dashboard.coupon.index'))->with('alert-success', 'Delete coupon success!');
    }
}
