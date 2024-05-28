<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
        $vehicleId = $this->route('vehicle')->id;

        $rules = [
            'plate' => 'required|string|max:255|unique:vehicles,plate,' . $vehicleId,
            'km' => 'required|integer|min:0',
            'condition' => 'required|integer|exists:vehicle_conditions,id',
            'fuel_type_id' => 'required|integer|exists:fuel_types,id',
            'car_category_id' => 'required|integer|exists:car_categories,id',
            'brand' => 'required|integer|exists:brands,id',
        ];

        if ($this->is_external) {
            $rules = array_merge($rules, [
                'contract_number' => 'required|string|max:255',
                'rental_price_per_day' => 'required|numeric|min:0',
                'rental_start_date' => 'required|date',
                'rental_end_date' => 'required|date|after:rental_start_date',
                'rental_company' => 'required|string|max:255',
                'rental_contact_person' => 'required|string|regex:/^[a-zA-Z\s]{3,}$/',
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
            'fuel_type_id.required' => 'Selecione o tipo de combustível do veículo.',
            'fuel_type_id.exists' => 'O tipo de combustível selecionado é inválido.',
            'car_category_id.required' => 'Selecione a categoria do veículo.',
            'car_category_id.exists' => 'A categoria selecionada é inválida.',
            'brand.required' => 'Selecione a marca do veículo.',
            'brand.exists' => 'A marca selecionada é inválida.',

            'contract_number.required' => 'O número do contrato é obrigatório para veículos externos.',
            'rental_price_per_day.required' => 'O preço de locação por dia é obrigatório para veículos externos.',
            'rental_price_per_day.numeric' => 'O preço de locação por dia deve ser um valor numérico.',
            'rental_price_per_day.min' => 'O preço de locação por dia não pode ser negativo.',
            'rental_start_date.required' => 'A data de início da locação é necessária para veículos externos.',
            'rental_start_date.date' => 'Informe uma data válida para o início da locação.',
            'rental_end_date.required' => 'A data de término da locação é necessária para veículos externos.',
            'rental_end_date.date' => 'Informe uma data válida para o término da locação.',
            'rental_end_date.after' => 'A data de término da locação deve ser posterior à data de início.',
            'rental_company.required' => 'O nome da empresa de locação é obrigatório para veículos externos.',
            'rental_contact_person.required' => 'O nome do contato da locação é obrigatório para veículos externos.',
            'rental_contact_person.regex' => 'O nome do contato deve ter pelo menos 3 letras e não deve conter números.',
            'rental_contact_number.required' => 'O número de contato da locação é obrigatório para veículos externos.',
            'pdf_file.file' => 'O arquivo deve ser do tipo PDF.',
            'pdf_file.mimes' => 'O arquivo deve ser do tipo PDF.',
            'pdf_file.max' => 'O tamanho máximo do arquivo é 2MB.',
        ];
    }
}
