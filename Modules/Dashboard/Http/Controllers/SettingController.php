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
        $oldCommissionSwap = $this->settingRepository->getValueByKey('commission_swap');
        $oldCommissionHunting = $this->settingRepository->getValueByKey('commission_hunting');
        $oldPayPal = $this->settingRepository->getValueByKey('admin_paypal');
        return view('dashboard::setting.index', compact('oldPayPal','oldCommissionSwap','oldCommissionHunting'));
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

        if( isset( $request->APIUsername ) && !empty( $request->APIUsername ) ){
            if( $this->settingRepository->findWhere(['key' =>'APIUsername'])->count() ){
                $this->settingRepository->update(['key' => 'APIUsername', 'value' => $request->APIUsername], $this->settingRepository->findWhere(['key' =>'APIUsername'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'APIUsername', 'value' => $request->APIUsername]);
            }
        }

        if( isset( $request->APIPassword ) && !empty( $request->APIPassword ) ){
            if( $this->settingRepository->findWhere(['key' =>'APIPassword'])->count() ){
                $this->settingRepository->update(['key' => 'APIPassword', 'value' => $request->APIPassword], $this->settingRepository->findWhere(['key' =>'APIPassword'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'APIPassword', 'value' => $request->APIPassword]);
            }
        }

        if( isset( $request->APISignature ) && !empty( $request->APISignature ) ){
            if( $this->settingRepository->findWhere(['key' =>'APISignature'])->count() ){
                $this->settingRepository->update(['key' => 'APISignature', 'value' => $request->APISignature], $this->settingRepository->findWhere(['key' =>'APISignature'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'APISignature', 'value' => $request->APISignature]);
            }
        }

        if( isset( $request->stripe_key ) && !empty( $request->stripe_key ) ){
            if( $this->settingRepository->findWhere(['key' =>'stripe_key'])->count() ){
                $this->settingRepository->update(['key' => 'stripe_key', 'value' => $request->stripe_key], $this->settingRepository->findWhere(['key' =>'stripe_key'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'stripe_key', 'value' => $request->stripe_key]);
            }
        }

        if( isset( $request->stripe_secret ) && !empty( $request->stripe_secret ) ){
            if( $this->settingRepository->findWhere(['key' =>'stripe_secret'])->count() ){
                $this->settingRepository->update(['key' => 'stripe_secret', 'value' => $request->stripe_secret], $this->settingRepository->findWhere(['key' =>'stripe_secret'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'stripe_secret', 'value' => $request->stripe_secret]);
            }
        }

        if( isset( $request->commission_swap ) && !empty( $request->commission_swap ) ){
            if( $this->settingRepository->findWhere(['key' =>'commission_swap'])->count() ){
                $this->settingRepository->update(['key' => 'commission_swap', 'value' => $request->commission_swap], $this->settingRepository->findWhere(['key' =>'commission_swap'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'commission_swap', 'value' => $request->commission_swap]);
            }
        }

        if( isset( $request->commission_hunting ) && !empty( $request->commission_hunting ) ){
            if( $this->settingRepository->findWhere(['key' =>'commission_hunting'])->count() ){
                $this->settingRepository->update(['key' => 'commission_hunting', 'value' => $request->commission_hunting], $this->settingRepository->findWhere(['key' =>'commission_hunting'])->first()->id);
            }else{
                $this->settingRepository->create(['key' => 'commission_hunting', 'value' => $request->commission_hunting]);
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
