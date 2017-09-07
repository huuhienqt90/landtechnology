<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class PostToCartRequest extends FormRequest
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
        $product = Product::find($this->getSegmentFromEnd());
        $rules = [];
        if( isset($product->id) && $product->id > 0 ){
            $rules['quantity'] = 'required|integer|between:1,'.$product->stock;
            if($product->attributes->groupBy('attribute_id')->count()):
                foreach($product->attributes->groupBy('attribute_id')->all() as $attr):
                    $rules['attrs.'.$attr->first()->attribute->id] = 'required';
                endforeach;
            endif;
        }
        return $rules;
    }

    public function messages()
    {
        $messages = parent::messages();
        $product = Product::find($this->getSegmentFromEnd());
        if( isset($product->id) && $product->id > 0 ){
            if($product->attributes->groupBy('attribute_id')->count()):
                foreach($product->attributes->groupBy('attribute_id')->all() as $attr):
                    $messages['attrs.'.$attr->first()->attribute->id.'.required'] = 'Please select product '.$attr->first()->attribute->name.".";
                endforeach;
            endif;
        }
        return $messages;
    }

    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }
}
