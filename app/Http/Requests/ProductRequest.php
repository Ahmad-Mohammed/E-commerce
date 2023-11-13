<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required",
            "description" => "required",
            // "image" => "required",
            // "category" => "required",
            // "quantity" => "required",
            // "price" => "required",
            // "discount_price" => "required"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'data'   => null,
            'message'   =>  $validator->errors(),
            'status'      => JsonResponse::HTTP_BAD_REQUEST
        ]));
    }




    public function messages(): array
    {
        return [
            // 'title.required' => 'A title is required',
            // 'title.max' => 'A title is very big',
        ];
    }
}
