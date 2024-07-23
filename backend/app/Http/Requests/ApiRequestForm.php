<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\UnprocessableEntityResource;

class ApiRequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }

    public function messages()
    {
        return [
            'required' => ':attribute.required',
            'string' => ':attribute.string',
            'lowercase' => ':attribute.lowercase',
            'email' => ':attribute.email',
            'exists' => ':attribute.exists',
            'unique' => ':attribute.unique',
            'min' => ':attribute.min',
            'max' => ':attribute.max',
            'confirmed' => ':attribute.confirmed',
            'numeric' => ':attribute.numeric',
            'digits_between' => ':attribute.digits_between',
            'min_digits' => 'attribute.min_digits',
            'max_digits' => 'attribute.max_digits',
            'image' => ':attribute.image',                        
        ];
    }

    public function failedValidation(Validator $validator)
    {
        (array) $errors = $validator->errors()->toArray();
        (array) $oneMessagePerError = array_map(fn($arrayMessage) => $arrayMessage[0], $errors);
        (string) $response = response()->json([
            'message' => 'Unprocessable Content',
            'errors' => $oneMessagePerError            
        ], 422);
        
        throw new HttpResponseException($response);
    }
}
