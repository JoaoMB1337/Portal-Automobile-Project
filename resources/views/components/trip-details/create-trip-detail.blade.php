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

        <form method="POST" action="{{ route('trip-details.store') }}"  enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="trip_id" class="block text-sm font-semibold text-gray-700 mb-2">Viagem</label>
                <select name="trip_id" id="trip_id" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('trip_id') border-red-500 @enderror" required>
                    <option value="">Selecione a Viagem</option>
                    @foreach ($trips as $trip)
                        <option value="{{ $trip->id }}">{{ $trip->destination}}</option>
                    @endforeach
                </select>
                @error('trip_id')
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
                <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo Total</label>
                <input id="cost" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror" name="cost" value="{{ old('cost') }}" required>
                @error('cost')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="receipt" class="block text-sm font-semibold text-gray-700 mb-2">Comprovante de Gastos</label>
                <input id="receipt" type="file" accept="image/*" capture="camera" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('receipt') border-red-500 @enderror" name="receipt">
                @error('receipt')
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const projectSelect = document.getElementById('project_id');
        const employeeSelect = document.getElementById('employee_id');
        projectSelect.addEventListener('change', function() {
        });
    });
</script>