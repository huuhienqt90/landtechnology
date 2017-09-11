<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\CommissionResponsitory;
use App\Repositories\CategoryResponsitory;
use Modules\Dashboard\Http\Requests\CommissionStoreRequest;
use Modules\Dashboard\Http\Requests\CommissionUpdateRequest;

class CommissionController extends Controller
{
    protected $commissionResponsitory;

    public function __construct(CommissionResponsitory $commissionResponsitory,
                                CategoryResponsitory $categoryResponsitory){
        $this->commissionResponsitory = $commissionResponsitory;
        $this->categoryResponsitory = $categoryResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $commissions = $this->commissionResponsitory->all();
        return view('dashboard::commissions.index', compact('commissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $commission = $this->commissionResponsitory;
        
        $cateArr = ['' => 'Select a subcategory'];

        $parentCates = $this->categoryResponsitory->findAllBy('parent_id', 0);
        $parentCateArr = ['' => 'Select a category'];
        foreach($parentCates as $parentCate){
            $parentCateArr[$parentCate->id] = $parentCate->name;
        }

        return view('dashboard::commissions.create', compact('commission','cateArr','parentCateArr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CommissionStoreRequest $request)
    {
        $param = $request->only(['type','cost','maximum','product_type']);
        if($request->category_id == null){
            $param['category_id'] = $request->category;
        }else{
            $param['category_id'] = $request->category_id;
        }
        $this->commissionResponsitory->create($param);
        return redirect(route('dashboard.commission.index'))->with('alert-success', 'Create commissions success!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::commissions.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $commission = $this->commissionResponsitory->find($id);

        $categories = $this->categoryResponsitory->all();
        $cateArr = ['' => 'Select a category'];
        foreach ($categories as $category) {
            $cateArr[$category->id] = $category->name; 
        }
        return view('dashboard::commissions.edit', compact('commission','cateArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CommissionUpdateRequest $request, $id)
    {
        $param = $this->commissionResponsitory->find($id);
        if($request->category_id == null){
            $param['category_id'] = $request->category;
        }else{
            $param['category_id'] = $request->category_id;
        }
        $param['type'] = $request->input('type');
        $param['cost'] = $request->input('cost');
        $param['maximum'] = $request->input('maximum');
        $param['product_type'] = $request->input('product_type');
        $param->update();
        return redirect(route('dashboard.commission.index'))->with('alert-success', 'Update commissions success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->commissionResponsitory->delete($id);
        return redirect(route('dashboard.commission.index'))->with('alert-success', 'Delete commissions success!');
    }

    public function getSubCategory(Request $request){
        if($request->ajax()){
            $id = $request->id;
            $data = $this->categoryResponsitory->findAllBy('parent_id', $id);
            return response()->json($data);
        }
    }
}
