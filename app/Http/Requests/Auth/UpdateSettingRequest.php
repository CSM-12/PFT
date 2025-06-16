<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'phone'      => ['required', 'digits:10'],

            'country'    => [
                'required',
                'string',
                'size:2',
                Rule::in(array_keys(config('country')))
            ],

            'language'   => [
                'required',
                'string',
                'size:2',
                Rule::in(array_keys(config('language')))
            ],

            'time_zone'  => [
                'required',
                'string',
                'max:40',
                Rule::in(array_keys(config('time_zone')))
            ],

            'currency'   => [
                'required',
                'string',
                'size:3',
                Rule::in(array_keys(config('currency')))
            ],
        ];
    }
}
