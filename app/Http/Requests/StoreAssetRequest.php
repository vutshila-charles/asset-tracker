<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'serial_number' => strtoupper($this->serial_number)
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'serial_number' => ['required','string','max:255','unique:assets,serial_number'],
            'status' => ['required','string','in:active,maintenance,retired']
        ];
    }

    public function messages(): array
    {
        return [
            'serial_number.unique' => 'This serial number already exists.'
        ];
    }
}
