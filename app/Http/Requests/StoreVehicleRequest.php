<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueWithTrashed;

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
        $vehicleId = $this->route('vehicle'); // Assuming route model binding or ID passed as route parameter

        $rules = [
            'plate' => ['required','string','max:20',new UniqueWithTrashed('vehicles', 'plate', $vehicleId),
            ],
            'km' => 'required|numeric|min:0|max:9999999',
            'condition' => 'required|exists:vehicle_conditions,id',
            'is_external' => 'nullable|boolean',
            'fuelTypes' => 'required|exists:fuel_types,id',
            'carCategory' => 'required|exists:car_categories,id',
            'brand' => 'required|exists:brands,id',
            'passenger_quantity' => 'nullable|integer|min:0|max:150',
            'notes' => 'nullable|string|max:150',
        ];

        if ($this->is_external) {
            $rules['contract_number'] = [
                'required',
                'string',
                'max:20',
                new UniqueWithTrashed('vehicles', 'contract_number', $vehicleId),
                'regex:/^\d+$/'
            ];
            $rules['rental_price_per_day'] = [
                'required',
                'regex:/^\d{1,6}([.,]\d{1,2})?$/',
                'min:0'
            ];
            $rules['rental_start_date'] = 'required|date';
            $rules['rental_end_date'] = 'required|date|after_or_equal:rental_start_date';
            $rules['rental_company'] = 'required|string|max:255';
            $rules['rental_contact_person'] = [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'min:1',
            ];
            $rules['rental_contact_number'] = [
                'required',
                'string',
                'max:12',
                'regex:/^\d+$/',
            ];
            $rules['pdf_file'] =[ 'nullable','file','mimes:pdf','max:2048'];
        }
        return $rules;
    }

    /**
     *
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'plate.required' => 'Por favor, insira a matrícula do veículo.',
            'plate.string' => 'A matrícula do veículo deve ser uma string.',
            'plate.max' => 'A matrícula do veículo não pode ter mais de 20 caracteres.',
            'plate.unique' => 'Esta matrícula já está em uso. Por favor, escolha outra.',
            'km.required' => 'Informe a quilometragem do veículo.',
            'km.numeric' => 'A quilometragem deve ser um número.',
            'km.min' => 'A quilometragem do veículo não pode ser negativa.',
            'km.max' => 'A quilometragem do veículo não pode ser superior a 9999999.',
            'condition.required' => 'Selecione a condição atual do veículo.',
            'condition.exists' => 'A condição selecionada é inválida.',
            'fuelTypes.required' => 'Selecione o tipo de combustível do veículo.',
            'fuelTypes.exists' => 'O tipo de combustível selecionado é inválido.',
            'carCategory.required' => 'Selecione a categoria do veículo.',
            'carCategory.exists' => 'A categoria selecionada é inválida.',
            'brand.required' => 'Selecione a marca do veículo.',
            'brand.exists' => 'A marca selecionada é inválida.',
            'passenger_quantity.integer' => 'A quantidade de passageiros deve ser um número inteiro.',
            'passenger_quantity.min' => 'A quantidade de passageiros deve ser no mínimo 0.',
            'passenger_quantity.max' => 'A quantidade de passageiros não pode ser superior a 150.',
            'notes.string' => 'As notas devem ser uma string.',
            'notes.max' => 'As notas não podem ter mais de 150 caracteres.',
            'pdf_file.file' => 'O arquivo deve ser do tipo PDF.',
            'pdf_file.mimes' => 'O arquivo deve ser do tipo PDF.',
            'pdf_file.max' => 'O tamanho máximo do arquivo é 2MB.',
            'contract_number.required' => 'O número do contrato é obrigatório para veículos externos.',
            'contract_number.string' => 'O número do contrato deve ser uma string.',
            'contract_number.max' => 'O número do contrato não pode ter mais de 20 caracteres.',
            'contract_number.unique' => 'O número do contrato já está em uso. Por favor, escolha outro.',
            'contract_number.regex' => 'O número do contrato não pode ser negativo.',
            'rental_price_per_day.required' => 'O preço de aluguer por dia é obrigatório para veículos externos.',
            'rental_price_per_day.regex' => 'O preço de aluguer por dia deve ser um número com até 6 dígitos e 2 casas decimais.',
            'rental_price_per_day.min' => 'O preço de aluguer por dia não pode ser negativo.',
            'rental_start_date.required' => 'A data de início da locação é necessária para veículos externos.',
            'rental_start_date.date' => 'Informe uma data válida para o início da locação.',
            'rental_end_date.required' => 'A data de término da locação é necessária para veículos externos.',
            'rental_end_date.date' => 'Informe uma data válida para o término da locação.',
            'rental_end_date.after_or_equal' => 'A data de término da locação deve ser posterior ou igual à data de início.',
            'rental_company.required' => 'O nome da empresa de locação é obrigatório para veículos externos.',
            'rental_company.string' => 'O nome da empresa de locação deve ser uma string.',
            'rental_company.max' => 'O nome da empresa de locação não pode ter mais de 255 caracteres.',
            'rental_contact_person.required' => 'O nome do contato da locação é obrigatório para veículos externos.',
            'rental_contact_person.string' => 'O nome do contato deve ser uma string.',
            'rental_contact_person.regex' => 'O nome do contato deve conter apenas letras e espaços e não pode ser negativo.',
            'rental_contact_number.required' => 'O número de contato da locação é obrigatório para veículos externos.',
            'rental_contact_number.string' => 'O número de contato deve ser uma string.',
            'rental_contact_number.max' => 'O número de contato não pode ter mais de 12 caracteres.',
            'rental_contact_number.regex' => 'O número de contato deve conter apenas dígitos.',
        ];
    }
}
