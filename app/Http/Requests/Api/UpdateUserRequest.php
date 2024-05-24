<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the mapped attributes to update.
     *
     * @return array
     */
    public function mappedAttributes(): array
    {
        $attributesMap = ['name', 'email', 'password', 'newPassword'];

        $attributesToUpdate = [];
        foreach ($attributesMap as $attribute) {
            if ($this->has($attribute)) {
                $attributesToUpdate[$attribute] = $this->input($attribute);
            }
        }

        return $attributesToUpdate;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $attributesToUpdate = $this->mappedAttributes();
        $updatingPassword = array_key_exists('newPassword', $attributesToUpdate);

        if ($updatingPassword) {
            // If updating password, validate oldPassword, newPassword, and confirmation
            return [
                'oldPassword' => ['required', 'string', 'current_password'],
                'newPassword' => ['required', 'string', 'confirmed'],
            ];
        } else {
            // If updating other attributes, ensure oldPassword is provided
            return [
                'name' => ['sometimes', 'string'],
                'email' => ['sometimes', 'string', 'email'],
                'password' => ['required_with:name,email', 'string', 'current_password'],
            ];
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.required_with' => 'Current password is required to update user data.',
            'newPassword.required_with' => 'New password is required when changing password.',
        ];
    }
}
