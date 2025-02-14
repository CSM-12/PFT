<?php

namespace App\Http\Requests\Saving;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSavingRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:100',
                // Unique constraint, respecting user_id
                Rule::unique('savings')->where(function ($query) {
                    return $query->where('user_id', 1);
                })->ignore($this->route('saving'))
            ],
            'description' => 'max:500',
            'target_amount' => 'numeric|min:0.01',
            'target_date' => 'date',
            'platform' => 'required|string|max:100'
        ];
    }
}
