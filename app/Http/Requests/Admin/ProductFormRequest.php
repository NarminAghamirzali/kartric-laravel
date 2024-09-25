<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title.*' => ['required', 'string', 'max:255'],
            'description.*' => ['required', 'string'],
            'short_description.*' => ['required', 'string'],
            'technical_description.*' => ['required', 'string'],
            'slug.*' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'price' => ['required', 'numeric', 'between:0,9999.99'],
            'category_id' => ['required', 'exists:categories,id'],
            "image" => [
                'nullable',
                'file',
                'mimes:jpg,png,svg,webp',
                'max:2048'
            ]
        ];
    }
}
