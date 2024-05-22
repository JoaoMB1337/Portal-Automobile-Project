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
            'employee_number' => 'required|string|max:255',
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

    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do funcionário.',
            'name.max' => 'O nome do funcionário não pode ter mais de 255 caracteres.',
            'employee_number.required' => 'Por favor, insira o número de funcionário.',
            'employee_number.max' => 'O número de funcionário não pode ter mais de 255 caracteres.',
            'email.required' => 'Por favor, insira o email do funcionário.',
            'email.email' => 'O email do funcionário deve ser um email válido.',
            'email.max' => 'O email do funcionário não pode ter mais de 255 caracteres.',
            'gender.required' => 'Por favor, selecione o género do funcionário.',
            'gender.in' => 'O género deve ser "male", "female" ou "other".',
            'birth_date.required' => 'Por favor, insira a data de nascimento do funcionário.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'CC.required' => 'Por favor, insira o número de cartão de cidadão (CC) do funcionário.',
            'CC.max' => 'O número de cartão de cidadão (CC) não pode ter mais de 255 caracteres.',
            'NIF.required' => 'Por favor, insira o número de identificação fiscal (NIF) do funcionário.',
            'NIF.max' => 'O número de identificação fiscal (NIF) não pode ter mais de 255 caracteres.',
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
