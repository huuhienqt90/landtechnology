<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'original_price' => 'required|numeric',
            'display_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'price_after_discount' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'sold_units' => 'required|numeric',
            'description' => 'required',
            'key_words' => 'required',
            'weight' => 'required',
            'location' => 'required',
            'seller_id' => 'required',
            'sell_type_id' => 'required',
            'product_brand' => 'required',
            'feature_image' => 'image|mimes:jpeg,bmp,png|size:4800'
        ];
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
