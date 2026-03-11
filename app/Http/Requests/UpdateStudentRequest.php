<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all requests
    }

   public function rules(): array
{
    $studentId = $this->route('student')->id ?? null;

    return [
        'name'  => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|email|unique:students,email,' . $studentId,
        'age'   => 'sometimes|required|numeric|min:16|max:60',
        'phone' => 'sometimes|nullable|string|max:15|unique:students,phone,' . $studentId
    ];
}

    public function validated($key=null, $default=null): array
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
        'email.unique' => 'Another student already has this email.',
        'phone.unique' => 'Another student already has this phone number.',
    ];
}
}