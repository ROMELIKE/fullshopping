<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'newpw'=>'required',
            'renewpw'=>'same:newpw',
        ];
    }
    public function messages()
    {
        return [
            'newpw.required'=>'Enter new password',
            'renewpw.same'=>'Password not match',
        ];
    }
}
