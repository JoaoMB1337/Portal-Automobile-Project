<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $employeeId = $this->employee->id;

        return [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'employee_number' => 'required|nullable|string|max:10|unique:employees,employee_number,' . $employeeId,
            'gender' => 'required|string',
            'birth_date' => ['required', 'date', function ($attribute, $value, $fail) {
                $current_date = Carbon::now();
                $birth_date = Carbon::parse($value);
                $age = $current_date->diff($birth_date)->format('%y');

                if ($birth_date > $current_date) {
                    $fail('A data de nascimento não pode ser no futuro');
                } elseif ($age < 18) {
                    $fail('A idade deve ser maior que 18 anos');
                } elseif ($age > 100) {
                    $fail('A idade deve ser no máximo 100 anos');
                }
            }],
            'CC' => 'required|string|digits:9|unique:employees,CC,' . $employeeId,
            'NIF' => 'required|string|digits:9|unique:employees,NIF,' . $employeeId,
            'address' => 'nullable|string|max:255',
            'employee_role_id' => 'required|exists:employee_roles,id',
            'email' => 'nullable|email|max:255|unique:employees,email,' . $employeeId,
            'phone' => 'nullable|string|max:255|unique:employees,phone,' . $employeeId,
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) use ($employeeId) {
                    $nif = $this->input('NIF');
                    $cc = $this->input('CC');

                    if (($value === $nif || $value === $cc) && !empty($value)) {
                        $fail('A senha não pode ser igual ao NIF ou ao CC.');
                    }
                },
            ],
            'driving_licenses' => 'nullable|array',
            'driving_licenses.*' => 'exists:driving_licenses,id',
            'contacts' => 'nullable|array',
            'contacts.*.value' => 'nullable|string|max:255',
            'contacts.*.type' => 'nullable|exists:contact_types,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do funcionário.',
            'name.min' => 'O nome do funcionário deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome do funcionário não pode ter mais de 255 caracteres.',
            'employee_number.required' => 'Por favor, insira o número de funcionário.',
            'employee_number.unique' => 'Este número de funcionário já está em uso. Por favor, escolha outro.',
            'employee_number.max' => 'O número de funcionário não pode ter mais de 10 caracteres.',
            'gender.required' => 'Por favor, selecione o género do funcionário.',
            'birth_date.required' => 'Por favor, insira a data de nascimento do funcionário.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'CC.required' => 'Por favor, insira o número de cartão de cidadão (CC) do funcionário.',
            'CC.digits' => 'O número de cartão de cidadão (CC) deve ter exatamente :digits dígitos.',
            'CC.unique' => 'Este número de cartão de cidadão (CC) já está em uso. Por favor, escolha outro.',
            'NIF.required' => 'Por favor, insira o número de identificação fiscal (NIF) do funcionário.',
            'NIF.digits' => 'O número de identificação fiscal (NIF) deve ter exatamente :digits dígitos.',
            'NIF.unique' => 'Este número de identificação fiscal (NIF) já está em uso. Por favor, escolha outro.',
            'address.string' => 'O endereço do funcionário deve ser uma string.',
            'address.max' => 'O endereço do funcionário não pode ter mais de 255 caracteres.',
            'employee_role_id.required' => 'Por favor, selecione o cargo do funcionário.',
            'employee_role_id.exists' => 'O cargo selecionado é inválido.',
            'email.email' => 'O email do funcionário deve ser um email válido.',
            'email.max' => 'O email do funcionário não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já está em uso. Por favor, escolha outro.',
            'phone.string' => 'O número de telefone do funcionário deve ser uma string.',
            'phone.max' => 'O número de telefone do funcionário não pode ter mais de 255 caracteres.',
            'phone.unique' => 'Este número de telefone já está em uso. Por favor, escolha outro.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'password.custom_rule' => 'A senha não pode ser igual ao NIF ou ao Cartão Cidadão (CC).',
            'driving_licenses.*.exists' => 'Uma ou mais das categorias de carta de condução selecionadas são inválidas.',
            'contacts.*.value.string' => 'O valor do contacto deve ser uma string.',
            'contacts.*.value.max' => 'O valor do contacto não pode ter mais de 255 caracteres.',
            'contacts.*.type.exists' => 'Um ou mais dos tipos de contacto selecionados são inválidos.',
        ];
    }
}
