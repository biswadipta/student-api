<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age'   => 'required|numeric|min:16|max:60',
            'phone' => 'nullable|string|max:15|unique:students,phone'
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated();

        if (isset($data['age'])) {
            $data['age'] = (int) $data['age'];
        }

        return $data;
    }
    public function messages(): array
{
    return [
        'email.unique' => 'This email is already registered.',
        'phone.unique' => 'This phone number is already registered.',
        'age.min'      => 'Student must be at least 16 years old.',
        'age.max'      => 'Student age cannot exceed 60 years.'
    ];
}
}