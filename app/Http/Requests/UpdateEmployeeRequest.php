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
            'name' => 'required|string|max:255|min:3',
            'employee_number' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $this->employee->id,
            'gender' => 'required|string|in:male,female,other',
            'birth_date' => 'required|date|before_or_equal:today - 100 years',
            'CC' => 'required|string|max:255|different:NIF', // Ensure CC is different from NIF
            'NIF' => 'required|string|max:255|different:CC', // Ensure NIF is different from CC
            'address' => 'required|string|max:255',
            'employee_role_id' => 'required|exists:employee_roles,id',
            'password' => 'nullable|string|min:8|confirmed',
            'driving_licenses' => 'array',
            'driving_licenses.*' => 'exists:driving_licenses,id',
            'contacts' => 'array',
            'contacts.*.contact' => 'required|string|max:255',
            'contacts.*.contact_type_id' => 'required|exists:contact_types,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do funcionário.',
            'name.min' => 'O nome do funcionário deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome do funcionário não pode ter mais de 255 caracteres.',
            'employee_number.required' => 'Por favor, insira o número de funcionário.',
            'employee_number.max' => 'O número de funcionário não pode ter mais de 255 caracteres.',
            'email.required' => 'Por favor, insira o email do funcionário.',
            'email.email' => 'O email do funcionário deve ser um email válido.',
            'email.max' => 'O email do funcionário não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já está em uso.',
            'gender.required' => 'Por favor, selecione o género do funcionário.',
            'gender.in' => 'O género deve ser "male", "female" ou "other".',
            'birth_date.required' => 'Por favor, insira a data de nascimento do funcionário.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before_or_equal' => 'O funcionário não pode ter mais de 100 anos.',
            'CC.required' => 'Por favor, insira o número de cartão de cidadão (CC) do funcionário.',
            'CC.max' => 'O número de cartão de cidadão (CC) não pode ter mais de 255 caracteres.',
            'CC.different' => 'O número de cartão de cidadão (CC) deve ser diferente do NIF.',
            'NIF.required' => 'Por favor, insira o número de identificação fiscal (NIF) do funcionário.',
            'NIF.max' => 'O número de identificação fiscal (NIF) não pode ter mais de 255 caracteres.',
            'NIF.different' => 'O número de identificação fiscal (NIF) deve ser diferente do CC.',
            'address.required' => 'Por favor, insira o endereço do funcionário.',
            'address.max' => 'O endereço do funcionário não pode ter mais de 255 caracteres.',
            'employee_role_id.required' => 'Por favor, selecione o cargo do funcionário.',
            'employee_role_id.exists' => 'O cargo selecionado é inválido.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'driving_licenses.array' => 'As licenças de condução devem ser um array.',
            'driving_licenses.*.exists' => 'A licença de condução selecionada é inválida.',
            'contacts.array' => 'Os contatos devem ser um array.',
            'contacts.*.contact.required' => 'Por favor, insira o contato.',
            'contacts.*.contact.max' => 'O contato não pode ter mais de 255 caracteres.',
            'contacts.*.contact_type_id.required' => 'Por favor, selecione o tipo de contato.',
            'contacts.*.contact_type_id.exists' => 'O tipo de contato selecionado é inválido.',
        ];
    }

}
