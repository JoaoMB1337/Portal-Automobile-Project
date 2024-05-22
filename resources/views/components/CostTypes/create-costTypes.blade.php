@props(['costTypes', 'projects'])

@extends('components.master.main')

@section('content')

<style>
    .custom-bg {
        background-color: #f5f5f5;
    }

    .custom-card {
        background-color: #ffffff;
        box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
    }

    .custom-btn {
        background-color: #000;
        color: #fff;
        transition: background-color 0.3s ease;
        border-radius: 30px;
    }

    .custom-btn:hover {
        background-color: #222;
    }

    .form-input,
    .form-control {
        border: 2px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-input:focus,
    .form-control:focus {
        border-color: #888;
    }

    @media (max-width: 640px) {
        .custom-logo {
            width: 80px;
            height: 80px;
        }
    }
</style>

<div class="flex justify-center items-start h-screen custom-bg">
    <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex justify-center mb-6">
            <h1>Registro de Pedidos de Despesas</h1>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('costs-types.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="project_id" class="block text-sm font-semibold text-gray-700 mb-2">Projeto</label>
                <select name="project_id" id="project_id" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('project_id') border-red-500 @enderror" required>
                    <option value="">Selecione o Projeto</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" data-employees="{{ json_encode($project->trips->flatMap->employees->pluck('name', 'id')) }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="employee_id" class="block text-sm font-semibold text-gray-700 mb-2">Funcionário</label>
                <select name="employee_id" id="employee_id" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('employee_id') border-red-500 @enderror" required>
                    <option value="">Selecione o Funcionário</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                    <!-- Os funcionários serão carregados dinamicamente aqui -->
                </select>
                @error('employee_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cost_type_id" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Custo</label>
                <select name="cost_type_id" id="cost_type_id" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost_type_id') border-red-500 @enderror" required>
                    <option value="">Selecione o Tipo de Custo</option>
                    @foreach ($costTypes as $costType)
                        <option value="{{ $costType->id }}">{{ $costType->type_name }}</option>
                    @endforeach
                </select>
                @error('cost_type_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="total_cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo Total</label>
                <input id="total_cost" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('total_cost') border-red-500 @enderror" name="total_cost" value="{{ old('total_cost') }}" required>
                @error('total_cost')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="custom-btn w-full py-2 rounded-md text-white">
                    Salvar
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection
