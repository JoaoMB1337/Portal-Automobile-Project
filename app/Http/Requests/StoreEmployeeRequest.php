<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            //
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'birth_date' => ['required', 'date'],
            'CC' => ['required', 'string', 'max:255', 'unique:employees'],
            'NIF' => ['required', 'string', 'max:255', 'unique:employees'],
            'address' => ['string', 'max:255', 'nullable'],
            'employee_role_id' => ['required', 'integer', 'exists:employee_roles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
