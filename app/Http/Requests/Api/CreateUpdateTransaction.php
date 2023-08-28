<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateTransaction extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'transaction_id' => 'sometimes|required|exists:financial_transactions,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_id.required' => 'The transaction ID is required.',
            'transaction_id.exists' => 'The selected transaction ID is invalid.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least :min.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than :max characters.',
        ];
    }


    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {

        $errorMessage = $validator->errors()->first();

        $response = $this->errorResponse($errorMessage, 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
