<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if( auth()->check() && auth()->user()->is_seller ){
            return true;
        }else{
            return abort('403');
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inputPrice' => 'required|numeric',
            'inputPhotos.*' => 'required|image|mimes:jpeg,bmp,png',
            'textareaComment' => 'required|min:10'
        ];
    }
}
