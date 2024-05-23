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
            'name' => ['required', 'string', 'max:255'],
            'employee_number' => ['required', 'numeric', 'unique:employees'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'birth_date' => ['required', 'date'],
            'CC' => ['required', 'numeric', 'digits:9', 'unique:employees'],
            'NIF' => ['required', 'numeric', 'digits:9', 'unique:employees'],
            'address' => ['string', 'max:255', 'nullable'],
            'employee_role_id' => ['required', 'integer', 'exists:employee_roles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do funcionário.',
            'name.max' => 'O nome do funcionário não pode ter mais de 255 caracteres.',
            'employee_number.required' => 'Por favor, insira o número de funcionário.',
            'employee_number.numeric' => 'O número de funcionário deve conter apenas números.',
            'employee_number.unique' => 'Este número de funcionário já está em uso. Por favor, escolha outro.',
            'gender.required' => 'Por favor, selecione o género do funcionário.',
            'birth_date.required' => 'Por favor, insira a data de nascimento do funcionário.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'CC.required' => 'Por favor, insira o número de cartão de cidadão (CC) do funcionário.',
            'CC.numeric' => 'O número de cartão de cidadão (CC) deve ser numérico.',
            'CC.digits' => 'O número de cartão de cidadão (CC) deve ter exatamente :digits dígitos.',
            'CC.unique' => 'Este número de cartão de cidadão (CC) já está em uso. Por favor, escolha outro.',
            'NIF.required' => 'Por favor, insira o número de identificação fiscal (NIF) do funcionário.',
            'NIF.numeric' => 'O número de identificação fiscal (NIF) deve ser numérico.',
            'NIF.max' => 'O número de identificação fiscal (NIF) não pode ter mais de 255 caracteres.',
            'NIF.unique' => 'Este número de identificação fiscal (NIF) já está em uso. Por favor, escolha outro.',
            'address.string' => 'O endereço do funcionário deve ser uma string.',
            'address.max' => 'O endereço do funcionário não pode ter mais de 255 caracteres.',
            'employee_role_id.required' => 'Por favor, selecione o cargo do funcionário.',
            'employee_role_id.exists' => 'O cargo selecionado é inválido.',
            'email.required' => 'Por favor, insira o email do funcionário.',
            'email.email' => 'O email do funcionário deve ser um email válido.',
            'email.max' => 'O email do funcionário não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já está em uso. Por favor, escolha outro.',
            'password.required' => 'Por favor, insira a senha do funcionário.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',


        ];
    }


}
