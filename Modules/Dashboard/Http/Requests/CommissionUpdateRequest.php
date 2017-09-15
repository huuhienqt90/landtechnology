<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommissionUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if( $request->type == 'percent' ) {
            return [
                'type' => 'required',
                'cost' => 'numeric',
                'product_type' => [
                    'required',
                    Rule::unique('commissions')->where(function ($query) use ($request) {
                        $query->where('product_type', $request->product_type)->where('category_id', $request->category_id)->first();
                    })->ignore($this->getSegmentFromEnd(), 'id')
                ],
                'category_id' => [
                    'required',
                    Rule::unique('commissions')->where(function ($query) use ($request) {
                        $query->where('product_type', $request->product_type)->where('category_id', $request->category_id)->first();
                    })->ignore($this->getSegmentFromEnd(), 'id')
                ],
                'maximum' => 'required|numeric'
            ];
        }else{
            return [
                'type' => 'required',
                'cost' => 'numeric',
                'product_type' => [
                    'required',
                    Rule::unique('commissions')->where(function ($query) use ($request) {
                        $query->where('product_type', $request->product_type)->where('category_id', $request->category_id)->first();
                    })->ignore($this->getSegmentFromEnd(), 'id')
                ],
                'category_id' => [
                    'required',
                    Rule::unique('commissions')->where(function ($query) use ($request) {
                        $query->where('product_type', $request->product_type)->where('category_id', $request->category_id)->first();
                    })->ignore($this->getSegmentFromEnd(), 'id')
                ],
            ];
        }
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
