<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'address1' => 'required',
            'username' => 'required|unique:users,username,'.$this->getSegmentFromEnd(),
            'email'    => 'required|email|unique:users,email,'.$this->getSegmentFromEnd(),
            'country' => 'required',
            'postal_code' => 'numeric'
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

    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }
}
