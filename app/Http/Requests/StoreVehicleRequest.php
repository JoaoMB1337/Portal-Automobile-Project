<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
        $rules = [
            'plate' => 'required|string|max:255|unique:vehicles,plate',
            'km' => 'required|integer|min:0',
            'condition' => 'required|integer|exists:vehicle_conditions,id',
            'is_external' => 'nullable|boolean',
            'fuelTypes' => 'required|integer|exists:fuel_types,id',
            'carCategory' => 'required|integer|exists:car_categories,id',
            'brand' => 'required|integer|exists:brands,id',
        ];

        if ($this->is_external) {
            $rules = array_merge($rules, [
                'contract_number' => 'required|string|max:255',
                'rental_price_per_day' => 'required|numeric|min:0',
                'rental_start_date' => 'required|date',
                'rental_end_date' => 'required|date|after:rental_start_date',
                'rental_company' => 'required|string|max:255',
                'rental_contact_person' => 'required|string|max:255',
                'rental_contact_number' => 'required|string|max:255',
                'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'plate.required' => 'Por favor, insira a placa do veículo.',
            'plate.unique' => 'Esta placa já está em uso. Por favor, escolha outra.',
            'plate.max' => 'A placa do veículo não pode ter mais de 255 caracteres.',
            'km.required' => 'Informe a quilometragem do veículo.',
            'km.integer' => 'A quilometragem deve ser um número inteiro.',
            'km.min' => 'A quilometragem do veículo não pode ser negativa.',
            'condition.required' => 'Selecione a condição atual do veículo.',
            'condition.exists' => 'A condição selecionada é inválida.',
            'fuelTypes.required' => 'Selecione o tipo de combustível do veículo.',
            'fuelTypes.exists' => 'O tipo de combustível selecionado é inválido.',
            'carCategory.required' => 'Selecione a categoria do veículo.',
            'carCategory.exists' => 'A categoria selecionada é inválida.',
            'brand.required' => 'Selecione a marca do veículo.',
            'brand.exists' => 'A marca selecionada é inválida.',

            'contract_number.required_if' => 'O número do contrato é obrigatório para veículos externos.',
            'rental_price_per_day.required_if' => 'O preço de locação por dia é obrigatório para veículos externos.',
            'rental_price_per_day.numeric' => 'O preço de locação por dia deve ser um valor numérico.',
            'rental_price_per_day.min' => 'O preço de locação por dia não pode ser negativo.',
            'rental_start_date.required_if' => 'A data de início da locação é necessária para veículos externos.',
            'rental_start_date.date' => 'Informe uma data válida para o início da locação.',
            'rental_end_date.required_if' => 'A data de término da locação é necessária para veículos externos.',
            'rental_end_date.date' => 'Informe uma data válida para o término da locação.',
            'rental_end_date.after' => 'A data de término da locação deve ser posterior à data de início.',
            'rental_company.required_if' => 'O nome da empresa de locação é obrigatório para veículos externos.',
            'rental_contact_person.required_if' => 'O nome do contato da locação é obrigatório para veículos externos.',
            'rental_contact_number.required_if' => 'O número de contato da locação é obrigatório para veículos externos.',
            'pdf_file.file' => 'O arquivo deve ser do tipo PDF.',
            'pdf_file.mimes' => 'O arquivo deve ser do tipo PDF.',
            'pdf_file.max' => 'O tamanho máximo do arquivo é 2MB.',
        ];
    }
}

