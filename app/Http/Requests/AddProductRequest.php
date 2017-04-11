<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name'=>'required|unique:product,name',
            'catid'=>'required',
            'price'=>'required|numeric'

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Enter Product name',
            'name.unique'=>'This Product name have been used',
            'catid.required'=>'Choose a Category for this product',
            'price.required'=>'Enter the price for thist product',
            'price.numeric'=>'this price is not correct'
        ];
    }
}
