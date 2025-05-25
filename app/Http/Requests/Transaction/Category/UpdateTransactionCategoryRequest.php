<?php

namespace App\Http\Requests\Transaction\Category;

use App\Enums\TransactionCategory\Period;
use App\Rules\ValidIcon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateTransactionCategoryRequest extends FormRequest
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
        return [
            'icon' => [
                'required',
                'string',
                'max:100',
                // Unique icon
                Rule::unique('transaction_categories')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($this->route('category')),

                // Valid icon 
                new ValidIcon
            ],
            'title' => [
                'required',
                'string',
                'max:100',
                // Unique constraint, respecting user_id
                Rule::unique('transaction_categories')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($this->route('category'))
            ],
            'description' => [
                'max:500'
            ],
            'budget' => [
                'numeric',
                'min:0.01'
            ],
            'period' => [
                'required',
                new Enum(Period::class)
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'You already have this category.'
        ];
    }
}
