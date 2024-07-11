<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon;

class UpdateTripRequest extends FormRequest
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
            'start_date' => ['required', 'date','after:today'],
            'end_date' => 'required|date|after_or_equal:start_date',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string|max:500',
            'employee_id' => 'required|exists:employees,id',
            'type_trip_id' => 'required|exists:type_trips,id',
            'project_id' => 'nullable|exists:projects,id',
        ];
    }



    public function messages()
    {
        return [
            'start_date.required' => 'A data de início é obrigatória.',
            'start_date.date' => 'A data de início deve ser uma data válida.',
            'start_date.after' => 'A data de início deve ser uma data futura.',
            'end_date.required' => 'A data de término é obrigatória.',
            'end_date.date' => 'A data de término deve ser uma data válida.',
            'end_date.after_or_equal' => 'A data de término deve ser igual ou posterior à data de início.',
            'destination.required' => 'O destino é obrigatório.',
            'destination.string' => 'O destino deve ser uma string.',
            'destination.max' => 'O destino não pode exceder 255 caracteres.',
            'purpose.required' => 'O propósito é obrigatório.',
            'purpose.string' => 'O propósito deve ser uma string.',
            'purpose.max' => 'O propósito não pode exceder 500 caracteres.',
            'employee_id.required' => 'O ID do empregado é obrigatório.',
            'employee_id.exists' => 'O ID do empregado deve existir na tabela de empregados.',
            'type_trip_id.required' => 'O tipo de viagem é obrigatório.',
            'type_trip_id.exists' => 'O ID do tipo de viagem deve existir na tabela de tipos de viagem.',
            'project_id.exists' => 'O ID do projeto deve existir na tabela de projetos, se fornecido.',
        ];
    }
}
