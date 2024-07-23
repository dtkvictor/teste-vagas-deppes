<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequestForm as FormRequest;
use App\Models\Category;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {                
        $current_category_id = $this->route('category')->id;
        return [
            'thumb' => 'required|image|max:2048',
            'name' => ['required','string','min:3','max:255', Rule::unique(Category::class, 'name')->ignore($current_category_id)],
            'description' => 'required|string|min:3|max:255'
        ];
    }
}
