<?php

namespace App\Http\Requests\Saving;

use App\Rules\ValidIcon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
            'icon' => [
                'required',
                'string',
                'max:100',
                // Unique icon
                Rule::unique('savings')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($this->route('saving')),

                // Valid icon 
                new ValidIcon
            ],
            'title' => [
                'required',
                'string',
                'max:100',
                // Unique constraint, respecting user_id
                Rule::unique('savings')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($this->route('saving'))
            ],
            'description' => 'max:500',
            'target_amount' => 'numeric|min:0.01',
            'target_date' => 'date',
            'platform' => 'required|string|max:100'
        ];
    }
}
