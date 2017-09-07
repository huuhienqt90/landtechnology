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

        $categories = $this->categoryResponsitory->all();
        $cateArr = ['' => 'Select a category'];
        foreach ($categories as $category) {
            $cateArr[$category->id] = $category->name; 
        }

        return view('dashboard::commissions.create', compact('commission','cateArr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CommissionStoreRequest $request)
    {
        $param = $request->all();
        $this->commissionResponsitory->create($param);
        return redirect(route('dashboard.commission.index'))->with('alert-success', 'Create commissions sucess!');
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
        $param['category_id'] = $request->input('category_id');
        $param['type'] = $request->input('type');
        $param['cost'] = $request->input('cost');
        $param['maximum'] = $request->input('maximum');
        $param['product_type'] = $request->input('product_type');
        $param->update();
        return redirect(route('dashboard.commission.index'))->with('alert-success', 'Update commissions sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->commissionResponsitory->delete($id);
        return redirect(route('dashboard.commission.index'))->with('alert-success', 'Delete commissions sucess!');
    }
}
