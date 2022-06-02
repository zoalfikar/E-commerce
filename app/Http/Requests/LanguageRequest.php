<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'abbe'=> 'required|max:10|string|unique:languages,abbe',
            'name'=> 'required|max:100|string',
            'locale'=> 'required|max:100|string',
            'direction'=> 'required|in:rtl,ltr',
        ];
    }
}
