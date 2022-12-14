<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'blogPic' => 'required|mimes:jpg,jpeg,png',
            'sample' => 'required|min:1|string'
        ];


    }


    public function messages()
    {
        return [
            'category_id.required' => 'Category field is required',
        ];
    }
}
