<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'fullname'=>'required',
            'username'=>'required|unique:user,username',
            'email'=>'required|email',
            'phone'=>'numeric',
            'address'=>'required',
            'avatar'=>'image|mimes:jpeg,jpg,png,gif|max:10240',
            'password'=>'required|min:4',
            'repassword'=>'same:password',
        ];
    }
    public function messages()
    {
        return [
            'fullname.required'=>'Enter your full name',
            'username.required'=>'Enter your username',
            'username.unique'=>'This username have been used',
            'email.required'=>'Enter your Email',
            'email.email'=>'Your email incorrect email format',
            'phone.numeric'=>'Phone must be number type',
            'address'=>'Enter your address',
            'avatar.image'=>'Your avatar is not an image',
            'avatar.mimes'=>'Your avatar must be an jpg,png,jpeg type image',
            'avatar.max'=>'Your avatar must less than 10MB',
            'password.required'=>'Enter your password',
            'password.min'=>'The password must more than 4 character',
            'repassword.same'=>'The password is not match',
        ];
    }
}
