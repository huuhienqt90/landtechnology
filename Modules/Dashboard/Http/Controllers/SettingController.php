<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\PaymentMethodResponsitory;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Http\Requests\SettingStoreRequest;

class SettingController extends Controller
{
    protected $paymentMethodResponsitory;
    protected $settingRepository;
    public function __construct(PaymentMethodResponsitory $paymentMethodResponsitory, SettingRepository $settingRepository)
    {
        $this->paymentMethodResponsitory = $paymentMethodResponsitory;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $oldPayPal = $this->settingRepository->getValueByKey('admin_paypal');
        return view('dashboard::setting.index', compact('oldPayPal'));
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
    public function store(SettingStoreRequest $request)
    {
        if( isset( $request->admin_paypal ) && !empty( $request->admin_paypal ) ){
            if( $this->settingRepository->findWhere(['key' =>'admin_paypal'])->count() ){
                $this->settingRepository->update(['key' => 'admin_paypal', 'value' => $request->admin_paypal], $this->settingRepository->findWhere(['key' =>'admin_paypal'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'admin_paypal', 'value' => $request->admin_paypal]);
            }
        }
        return redirect()->route('dashboard.setting.index')->with('alert-success', 'Update e-commerce setting sucess!');
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
    public function edit()
    {
        return view('dashboard::edit');
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
