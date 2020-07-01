<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageValidationRequest extends FormRequest
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
            //
            'title'=>'required|min:4|max:128',
            'seo_title'=>'required|min:4|max:128',
            'seo_description'=>'required|min:8',
            'content'=>'required|min:128',
            'is_public'=>'required',
        ];
    }
}