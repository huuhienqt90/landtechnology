<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommissionStoreRequest extends FormRequest
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
                    })
                ],
                'category_id' => [
                    'required',
                    Rule::unique('commissions')->where(function ($query) use ($request) {
                        $query->where('product_type', $request->product_type)->where('category_id', $request->category_id)->first();
                    })
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
                    })
                ],
                'category_id' => [
                    'required',
                    Rule::unique('commissions')->where(function ($query) use ($request) {
                        $query->where('product_type', $request->product_type)->where('category_id', $request->category_id)->first();
                    })
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
}
