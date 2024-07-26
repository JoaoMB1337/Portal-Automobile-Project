<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
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
    public function rules()
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'insurance_company' => 'required|string|max:255',
            'policy_number' => 'required|string|max:255|unique:insurances,policy_number',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'cost' => ['required', 'regex:/^\d{1,3}(\.\d{3})*(\,\d{2})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required' => 'O veículo é obrigatório.',
            'vehicle_id.exists' => 'O veículo selecionado não existe.',
            'vehicle_id.integer' => 'O veículo deve ser um número inteiro.',
            'insurance_company.required' => 'A companhia de seguros é obrigatória.',
            'insurance_company.string' => 'A companhia de seguros deve ser uma string.',
            'insurance_company.max' => 'A companhia de seguros não pode ter mais de 255 caracteres.',
            'policy_number.required' => 'O número da apólice é obrigatório.',
            'policy_number.string' => 'O número da apólice deve ser uma string.',
            'policy_number.max' => 'O número da apólice não pode ter mais de 255 caracteres.',
            'policy_number.unique' => 'O número da apólice já está em uso.',
            'start_date.required' => 'A data de início é obrigatória.',
            'start_date.date' => 'A data de início deve ser uma data válida.',
            'start_date.before' => 'A data de início deve ser antes da data de término.',
            'end_date.required' => 'A data de término é obrigatória.',
            'end_date.date' => 'A data de término deve ser uma data válida.',
            'end_date.after' => 'A data de término deve ser depois da data de início.',
            'cost.required' => 'O custo é obrigatório.',
            'cost.regex' => 'O custo não esta no formato',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cost' => str_replace('.', ',', $this->cost),
        ]);
    }
}
