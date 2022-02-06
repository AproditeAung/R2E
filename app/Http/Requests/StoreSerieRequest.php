<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerieRequest extends FormRequest
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
            'episode' => 'integer|required|min:1',
            'quality' => 'required|min:0|max:3|integer',
            'movie_id' => 'required|exists:movies,id'
        ];
    }
}
