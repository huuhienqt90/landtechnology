<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SwappingUpdateRequest extends FormRequest
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
            'description' => 'required',
            'description_short' => 'required',
            'sell_type_id' => 'required',
            'product_brand' => 'required',
            'feature_image' => 'image|mimes:jpeg,bmp,png',
            'category' => 'required'
        ];
    }
}
