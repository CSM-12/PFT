<?php

namespace App\Http\Requests\Transaction;

use App\Rules\Transaction\CategoryType;
use App\Rules\Transaction\HasSufficientSavings;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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

        $rules = [
            'amount' => [
                'required',
                'numeric',
                'decimal:2',
                'min:0',
            ],
            'title' => [
                'nullable',
                'string',
                'max:100'
            ],
            'description' => [
                'nullable',
                'string',
                'max:500'
            ],
            'category_type' => [
                'required',
                'string',
                'in:transaction,saving,investment'
            ],
            'category_id' => [
                'required',
                new CategoryType($this->input('category_type'))
            ],
            'direction' => [
                'required',
                'in:0,1'
            ],
            'status' => [
                'required',
                'in:completed,pending,failed'
            ]
        ];

        // Apply the rule only when direction is 0 (withdrawal) and category_type is 'saving'
        if ($this->input('direction') === '0' && $this->input('category_type') === 'saving') {
            $rules['amount'][] = new HasSufficientSavings($this->input('category_id'));
        }

        return $rules;
    }
}
