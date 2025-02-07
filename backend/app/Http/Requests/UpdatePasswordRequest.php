<?php

namespace App\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Http\Requests\ApiRequestForm as FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];
    }
}
