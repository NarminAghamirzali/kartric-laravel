<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LangFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                'required',
                'string',
                'max:50'
            ],
            "code" => [
                'required',
                'string',
                'max:3'
            ],
            "flag" => [
                'nullable',
                'file',
                'mimes:jpg,png,svg',
                'max:2048'
            ]
        ];
    }
}
