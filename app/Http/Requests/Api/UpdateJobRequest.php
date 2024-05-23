<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function mappedAttributes(): array
    {
        $attributesMap = ['title', 'salary', 'location', 'schedule', 'url', 'tags'];


        $attributesToUpdate = [];
        foreach($attributesMap as $attribute){
            if($this->has($attribute)){
                $attributesToUpdate[$attribute] = $this->input($attribute);
            }
        }

        return $attributesToUpdate;
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
            'location' => ['required', 'string'],
            'schedule' => ['required', 'in:Part Time,Full Time', 'string'],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ];

        $attributesToUpdate = $this->mappedAttributes();
        return array_intersect_key($rules, $attributesToUpdate);
        // return $rules;
    }

    
}
