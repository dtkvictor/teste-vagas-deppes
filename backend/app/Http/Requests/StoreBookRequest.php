<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequestForm as FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Book;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:255',
            'isbn' => 'required|string|min:10|max:20',
            'description' => 'required|string|min:3|max:500',
            'number_pages' => 'required|numeric|min_digits:1|max_digits:4',
            'publisher' => 'required|string|max:255|min:3',
            'category_id' => 'required|numeric|exists:categories,id',            
        ];
    }
}
