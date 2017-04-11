<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'fullname' => 'required',
            'username' => 'required|unique:user,username',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'repassword' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Enter User fullname',
            'username.required'=>'Enter User username',
            'username.unique'=>'This username already in use',
            'email.required'=>'Enter User Email address',
            'email.email'=>'Enter User email format',
            'password.required'=>'Enter User password',
            'password.min'=>'Password must have atleast 4 characters',
            'repassword.required'=>'Enter User repassword',
            'repassword.same'=>'The password not match',
        ];
    }
}
