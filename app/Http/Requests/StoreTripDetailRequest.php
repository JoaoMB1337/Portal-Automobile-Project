<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripDetailRequest extends FormRequest
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
            'trip_id' => 'required|exists:trips,id',
            'cost_type_id' => 'required|exists:cost_types,id',
            'cost' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'trip_id.required' => 'O campo "trip_id" é obrigatório.',
            'trip_id.exists' => 'O ID da viagem fornecido não existe.',
            'cost_type_id.required' => 'O campo "cost_type_id" é obrigatório.',
            'cost_type_id.exists' => 'O ID do tipo de custo fornecido não existe.',
            'cost.required' => 'O valor é um campo obrigatório.',
            'cost.numeric' => 'O valor tem quer um numero',
            'cost.min' => 'O valor nao pode ser nagtivo',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Substitui vírgulas por pontos no campo "cost"
        if ($this->has('cost')) {
            $this->merge([
                'cost' => str_replace(',', '.', $this->input('cost'))
            ]);
        }
    }
}
