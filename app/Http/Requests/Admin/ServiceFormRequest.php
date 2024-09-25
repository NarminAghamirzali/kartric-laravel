<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title.*" => [
                'required',
                'string',
                'max:255'
            ],
            "description.*" => [
                'required'
            ],
            "image" => [
                'nullable',
                'file',
                'mimes:jpg,png,svg',
                'max:2048'
            ]
        ];
    }
}
