<?php

namespace App\Http\Requests;

//use App\Http\Requests\ApiRequestForm as FormRequest;

class UpdateBookRequest extends StoreBookRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'thumb' => 'image|max:2048',
        ]);
    }
}
