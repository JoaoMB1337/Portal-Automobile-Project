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
            'vehicle_plate' => 'required|string|exists:vehicles,plate',
            'insurance_company' => 'required|string|max:255',
            'policy_number' => 'required|string|max:255|unique:insurances,policy_number',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'cost' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'vehicle_plate.required' => 'A matrícula do veículo é obrigatória.',
            'vehicle_plate.string' => 'A matrícula do veículo deve ser uma string.',
            'vehicle_plate.exists' => 'Veículo com a matrícula fornecida não encontrado.',
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
            'cost.numeric' => 'O custo deve ser um valor numérico.',
            'cost.min' => 'O custo deve ser um valor positivo.',
        ];
    }
}
