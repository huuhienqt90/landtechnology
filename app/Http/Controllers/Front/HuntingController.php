<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HuntingStoreRequest;
use App\Http\Requests\HuntingUpdateRequest;
use App\Repositories\HuntingResponsitory;
use App\Repositories\CountryResponsitory;

class HuntingController extends Controller
{
    protected $huntingResponsitory;
    protected $countryResponsitory;

    public function __construct(HuntingResponsitory $huntingResponsitory,
                                CountryResponsitory $countryResponsitory)
    {
        $this->huntingResponsitory = $huntingResponsitory;
        $this->countryResponsitory = $countryResponsitory;
        $this->middleware('check.auth:seller');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->huntingResponsitory->findAllBy('user_id', auth()->user()->id);
        return view('front.hunting.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = $this->countryResponsitory->arrCountries();

        return view('front.hunting.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HuntingStoreRequest $request)
    {
        $param = $request->only(['name', 'slug', 'price', 'country_id', 'description']);
        $param['user_id'] = auth()->user()->id;
        if( $request->hasFile('image_path') ){
            $path = $request->file('image_path')->store('hunting_product/features');
            $param['image_path'] = $path;
        }
        $this->huntingResponsitory->create($param);
        return redirect(route('hunting.index'))->with('msgOk', 'Product\'s Hunting Was Created Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = $this->countryResponsitory->arrCountries();
        $product = $this->huntingResponsitory->find($id);

        return view('front.hunting.edit', compact('countries','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HuntingUpdateRequest $request, $id)
    {
        $product = $this->huntingResponsitory->find($id);
        $param = $request->only(['name', 'slug', 'price', 'country_id', 'description']);
        $param['user_id'] = auth()->user()->id;
        if( $request->hasFile('image_path') ){
            \Storage::delete($product->image_path);
            $path = $request->file('image_path')->store('hunting_product/features');
            $param['image_path'] = $path;
        }
        $this->huntingResponsitory->update($param, $id);
        return redirect(route('hunting.index'))->with('msgOk', 'Product\'s Hunting Was Updated Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->huntingResponsitory->find($id);
        if( $product->image_path != null ) {
            \Storage::delete($product->image_path);
        }
        $this->huntingResponsitory->delete($id);
        return redirect(route('hunting.index'))->with('msgOk', 'Product\'s Hunting Was Deleted Success');
    }
}
