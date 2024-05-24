<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'projectstatus' => 'required|exists:project_statuses,id',
            'district' => 'required|exists:districts,id',
            'country' => 'required|exists:countries,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do projeto.',
            'name.max' => 'O nome do projeto não pode ter mais de 255 caracteres.',
            'address.required' => 'Por favor, insira o endereço do projeto.',
            'address.max' => 'O endereço do projeto não pode ter mais de 255 caracteres.',
            'projectstatus.required' => 'Selecione o status do projeto.',
            'projectstatus.exists' => 'O status selecionado é inválido.',
            'district.required' => 'Selecione o distrito do projeto.',
            'district.exists' => 'O distrito selecionado é inválido.',
            'country.required' => 'Selecione o país do projeto.',
            'country.exists' => 'O país selecionado é inválido.',
        ];
    }


}
