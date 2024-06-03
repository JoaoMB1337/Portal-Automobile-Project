<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'employee_number' => ['required', 'numeric', 'unique:employees'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'birth_date' => ['required', 'date', 'before_or_equal:today - 100 years'],
            'CC' => ['required', 'numeric', 'digits:9', 'unique:employees', 'different:NIF'],
            'NIF' => ['required', 'numeric', 'digits:9', 'unique:employees', 'different:CC'],
            'address' => ['string', 'max:255', 'nullable'],
            'employee_role_id' => ['required', 'integer', 'exists:employee_roles,id'],
            'phone_number' => ['required', 'numeric', 'digits_between:9,12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do funcionário.',
            'name.min' => 'O nome do funcionário deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome do funcionário não pode ter mais de 255 caracteres.',
            'employee_number.required' => 'Por favor, insira o número de funcionário.',
            'employee_number.numeric' => 'O número de funcionário deve conter apenas números.',
            'employee_number.unique' => 'Este número de funcionário já está em uso. Por favor, escolha outro.',
            'gender.required' => 'Por favor, selecione o género do funcionário.',
            'birth_date.required' => 'Por favor, insira a data de nascimento do funcionário.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before_or_equal' => 'O funcionário não pode ter mais de 100 anos.',
            'CC.required' => 'Por favor, insira o número de cartão de cidadão (CC) do funcionário.',
            'CC.numeric' => 'O número de cartão de cidadão (CC) deve ser numérico.',
            'CC.digits' => 'O número de cartão de cidadão (CC) deve ter exatamente :digits dígitos.',
            'CC.unique' => 'Este número de cartão de cidadão (CC) já está em uso. Por favor, escolha outro.',
            'CC.different' => 'O número de cartão de cidadão (CC) e NIF devem ser diferentes.',
            'NIF.required' => 'Por favor, insira o número de identificação fiscal (NIF) do funcionário.',
            'NIF.numeric' => 'O número de identificação fiscal (NIF) deve ser numérico.',
            'NIF.digits' => 'O número de identificação fiscal (NIF) deve ter exatamente :digits dígitos.',
            'NIF.unique' => 'Este número de identificação fiscal (NIF) já está em uso. Por favor, escolha outro.',
            'NIF.different' => 'O número de identificação fiscal (NIF) e CC devem ser diferentes.',
            'address.string' => 'O endereço do funcionário deve ser uma string.',
            'address.max' => 'O endereço do funcionário não pode ter mais de 255 caracteres.',
            'employee_role_id.required' => 'Por favor, selecione o cargo do funcionário.',
            'employee_role_id.exists' => 'O cargo selecionado é inválido.',
            'email.required' => 'Por favor, insira o email do funcionário.',
            'email.email' => 'O email do funcionário deve ser um email válido.',
            'email.max' => 'O email do funcionário não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já está em uso. Por favor, escolha outro.',
            'phone_number.required' => 'Por favor, insira o número de telefone do funcionário.',
            'phone_number.numeric' => 'O número de telefone do funcionário deve conter apenas números.',
            'password.required' => 'Por favor, insira a senha do funcionário.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ];
    }
}
