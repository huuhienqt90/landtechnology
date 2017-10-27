<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductStoreRequest extends FormRequest
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
            'feature_image' => 'required|image'
        ];
        if( $product_type == 'simple' ) {
            $rules['original_price'] = 'required';
            $rules['sale_price'] = 'required';
        }elseif( $product_type == 'variable' ) {
            $variations = $request->variationNew;
            if( isset($variations) && count($variations) > 0 )
            foreach($variations as $keys => $items) {
                if($keys == '!#name#!') continue;
                $rules['variationNew.'.$keys.'.original_price'] = 'required|numeric';
                $rules['variationNew.'.$keys.'.sale_price'] = 'numeric';
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
}
