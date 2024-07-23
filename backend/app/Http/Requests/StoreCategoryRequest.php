<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequestForm as FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [        
            'thumb' => 'required|image|max:2048',
            'name' => 'required|string|min:3|max:255|unique:categories,name',
            'description' => 'required|string|min:3|max:255'
        ];
    }
}
