<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInspectionRequest extends FormRequest
{
    /**
     * Allow the request
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Normalize input before validation
     */
    protected function prepareForValidation()
    {
        if ($this->has('passed')) {
            $this->merge([
                'passed' => filter_var($this->passed, FILTER_VALIDATE_BOOLEAN)
            ]);
        }
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'inspector_name' => ['required','string','max:255'],
            'passed' => ['required','boolean'],
            'notes' => ['nullable','string','max:1000']
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'inspector_name.required' => 'Inspector name is required.',
            'passed.required' => 'Inspection result is required.',
            'passed.boolean' => 'Passed must be true or false.'
        ];
    }
}
