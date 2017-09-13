<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HuntingStoreRequest extends FormRequest
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
    public function rules()
    {
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
            'feature_image' => 'required|image|mimes:jpeg,bmp,png',
            'category' => 'required'
        ];
    }
}
