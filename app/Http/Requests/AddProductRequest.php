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
            'name'=>'required|unique:product,name|max:100',
            'catid'=>'required',
            'price'=>'required|numeric|digits_between:1,10',
            'count'=>'required|numeric',
            'thumbnail'=>'image|mimes:jpeg,jpg,png,gif|max:10240',
            'listimg'=>'image|mimes:jpeg,jpg,png,gif|max:10240',
            'desciption'=>'max:300'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Enter Product name',
            'name.unique'=>'This Product name have been used',
            'name.max'=>'This Product name can not more than 100 character',
            'catid.required'=>'Choose a Category for this product',
            'price.required'=>'Enter the price for thist product',
            'price.numeric'=>'this price is not correct',
            'price.max'=>'this price can not more than 10 digits',
            'count.required'=>'Enter number of product',
            'count.numeric'=>'number of product must be a numberic',
            'thumbnail.image'=>'This file is not a image',
            'thumbnail.mimes'=>'This file is not a imageformat',
            'thumbnail.max'=>'This file is too big, less than 10MB',
            'desciption.max'=>'The description too long, less than 300 characters'
        ];
    }
}
