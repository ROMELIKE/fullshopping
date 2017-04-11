<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name'=>'required',
            'cate_id'=>'required',
            'price'=>'required|numeric',
            'count'=>'required|numeric',
            'thumbnail'=>'image|mimes:jpeg,jpg,png,gif|max:1024',
            'desciption'=>'max:300'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Enter Product name',
            'name.unique'=>'This Product name have been used',
            'catid.required'=>'Choose a Category for this product',
            'price.required'=>'Enter the price for thist product',
            'price.numeric'=>'this price is not correct',
            'count.required'=>'Enter number of product',
            'count.numeric'=>'number of product must be a numberic',
            'thumbnail.image'=>'This file is not a image',
            'thumbnail.mimes'=>'This file is not a imageformat',
            'thumbnail.max'=>'This file is too big, less than 1024kb',
            'desciption.max'=>'The description too long, less than 300 characters'
        ];
    }
}
