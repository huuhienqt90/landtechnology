<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billingFirstName' => 'required',
            'billingLastName' => 'required',
            'billingCompany' => 'required',
            'billingAddress1' => 'required',
            'billingPostCode' => 'required',
            'billingCity' => 'required',
            'billingPhone' => 'required',
            'billingEmail' => 'required',

            'shippingFirstName' => 'required',
            'shippingLastName' => 'required',
            'shippingCompany' => 'required',
            'shippingAddress1' => 'required',
            'shippingPostCode' => 'required',
            'shippingCity' => 'required',
            'shippingPhone' => 'required',
            'shippingEmail' => 'required'
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
