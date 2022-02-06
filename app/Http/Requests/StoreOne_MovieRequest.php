<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOne_MovieRequest extends FormRequest
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
            'download_link' => 'required|url',
            'rating' => 'required|min:1|max:5|integer',
            'movie_id' => 'exists:movies,id',
            'quality' => 'required|min:0|max:3'
        ];

    }

    public function messages()
    {
        return [
            'quality.required' => 'You Must Choose Quality',
            'quality.*' => 'You Must Choose Quality',
        ];
    }
}
