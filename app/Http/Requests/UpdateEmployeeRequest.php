<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|string|in:male,female,other',
            'birth_date' => 'required|date',
            'CC' => 'required|string|max:255',
            'NIF' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'employee_role_id' => 'required|exists:employee_roles,id',
            'password' => 'nullable|string|min:8|confirmed',
            'driving_licenses' => 'array',
            'driving_licenses.*' => 'exists:driving_licenses,id',
        ];
    }
}
