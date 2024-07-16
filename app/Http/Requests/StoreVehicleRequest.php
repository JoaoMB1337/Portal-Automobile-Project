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
        return [
            'plate' => 'required|string|max:255|unique:vehicles,plate',
            'km' => 'required|numeric|min:0',
            'condition' => 'required|exists:vehicle_conditions,id',
            'is_external' => 'nullable|boolean',
            'fuelTypes' => 'required|exists:fuel_types,id',
            'carCategory' => 'required|exists:car_categories,id',
            'brand' => 'required|exists:brands,id',
            'passenger_quantity' => 'nullable|integer|min:1',
            'rental_price_per_day' => [
                'nullable',
                'regex:/^\d{1,6}([.,]\d{1,2})?$/',
            ],
            'contract_number' => 'nullable|string|max:255|unique:vehicles,contract_number',
            'rental_start_date' => 'nullable|date',
            'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'rental_company' => 'nullable|string|max:255',
            'rental_contact_person' => 'nullable|string|max:255',
            'rental_contact_number' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'plate.required' => 'Por favor, insira a matricula do veículo.',
            'plate.unique' => 'Esta matricula já está em uso. Por favor, escolha outra.',
            'plate.max' => 'A matricula do veículo não pode ter mais de 255 caracteres.',
            'km.required' => 'Informe a quilometragem do veículo.',
            'km.numeric' => 'A quilometragem deve ser um número.',
            'km.min' => 'A quilometragem do veículo não pode ser negativa.',
            'condition.required' => 'Selecione a condição atual do veículo.',
            'condition.exists' => 'A condição selecionada é inválida.',
            'fuelTypes.required' => 'Selecione o tipo de combustível do veículo.',
            'fuelTypes.exists' => 'O tipo de combustível selecionado é inválido.',
            'carCategory.required' => 'Selecione a categoria do veículo.',
            'carCategory.exists' => 'A categoria selecionada é inválida.',
            'brand.required' => 'Selecione a marca do veículo.',
            'brand.exists' => 'A marca selecionada é inválida.',
            'passenger_quantity.integer' => 'A quantidade de passageiros deve ser um número inteiro.',
            'passenger_quantity.min' => 'A quantidade de passageiros deve ser no mínimo 1.',
            'contract_number.required' => 'O número do contrato é obrigatório para veículos externos.',
            'contract_number.unique' => 'O número do contrato já está em uso. Por favor, escolha outro.',
            'rental_price_per_day.required' => 'O preço de locação por dia é obrigatório para veículos externos.',
            'rental_price_per_day.regex' => 'O preço de locação por dia deve ser um valor numérico.',
            'rental_start_date.required' => 'A data de início da locação é necessária para veículos externos.',
            'rental_start_date.date' => 'Informe uma data válida para o início da locação.',
            'rental_end_date.required' => 'A data de término da locação é necessária para veículos externos.',
            'rental_end_date.date' => 'Informe uma data válida para o término da locação.',
            'rental_end_date.after_or_equal' => 'A data de término da locação deve ser posterior ou igual à data de início.',
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
