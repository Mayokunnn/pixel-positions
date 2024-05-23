<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'salary' => ['required', 'decimal:0,2'],
            'location' => ['required','string'],
            'schedule' => ['required', 'in:Part Time,Full Time', 'string'],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'schedule' => 'The schedule value is invalid. Please use Part Time or Full Time',
            'location' => 'The location value is invalid. Please use a valid address',
        ];
    }
}
