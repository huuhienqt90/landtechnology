<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if( $request->product_type == 'simple' ) {
            return [
                'name' => 'required',
                'slug' => 'required',
                'original_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
                'stock' => 'required|numeric',
                'description' => 'required',
                'description_short' => 'required',
                'key_words' => 'required',
                'weight' => 'required',
                'location' => 'required',
                'sell_type_id' => 'required',
                'product_brand' => 'required',
                'feature_image' => 'image|mimes:jpeg,bmp,png',
                'category' => 'required'
            ];
        }
        if( $request->product_type == 'booking' ) {
            return [
                'name' => 'required',
                'slug' => 'required',
                'original_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
                'description' => 'required',
                'description_short' => 'required',
                'sell_type_id' => 'required',
                'feature_image' => 'image|mimes:jpeg,bmp,png',
                'category' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
            ];
        }
    }
}
