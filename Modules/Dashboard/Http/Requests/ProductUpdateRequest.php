<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $product_type = $request->product_type;
        $rules = [
            'name' => 'required',
            'status' => 'required',
            'description_short' => 'required',
            'description' => 'required',
            'sell_type' => 'required|numeric|min:1',
        ];
        if( $product_type == 'simple' ) {
            $rules['original_price'] = 'required|numeric';
            $rules['sale_price'] = 'required|numeric';
        }elseif( $product_type == 'variable' ) {
            $variations = $request->variation;
            if( isset($variations) && count($variations) > 0 )
            foreach($variations as $keys => $items) {
                if($keys == '!#name#!') continue;
                $rules['variation.'.$keys.'.original_price'] = 'required|numeric';
                $rules['variation.'.$keys.'.sale_price'] = 'required|numeric';
            }

            $variationNew = $request->variationNew;
            if( isset($variationNew) && count($variationNew) > 0 )
            foreach($variationNew as $keys => $items) {
                if($keys == '!#name#!') continue;
                $rules['variationNew.'.$keys.'.original_price'] = 'required|numeric';
                $rules['variationNew.'.$keys.'.sale_price'] = 'required|numeric';
            }
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }
}
