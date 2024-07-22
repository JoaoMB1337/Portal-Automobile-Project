<div class="mt-8">
    <form method="POST" action="{{ route('trip-details.update', ['trip_detail' => $tripDetail->id]) }}" enctype="multipart/form-data" class="space-y-10 bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <a href="{{ route('home') }}">
            <button type="button" class="flex items-center justify-center mb-3 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-500">
                <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
            </button>
        </a>
        <div>
            <label for="trip_id" class="block text-sm font-semibold text-gray-700 mb-2">Viagem</label>
            <select name="trip_id" id="trip_id" class="form-select w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('trip_id') border-red-500 @enderror" required {{ isset($tripId) ? 'disabled' : '' }}>
                <option value="">Selecione a viagem</option>
                @foreach ($trips as $trip)
                    <option value="{{ $trip->id }}" {{ old('trip_id', $tripDetail->trip_id) == $trip->id ? 'selected' : '' }}>
                        {{ $trip->destination }}
                    </option>
                @endforeach
            </select>
            @error('trip_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            @if (isset($tripId))
                <input type="hidden" name="trip_id" value="{{ $tripId }}">
            @endif
        </div>

        <div>
            <label for="cost_type_id" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de custo</label>
            <select name="cost_type_id" id="cost_type_id" class="form-select w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost_type_id') border-red-500 @enderror" required>
                <option value="">Selecione o tipo de custo</option>
                @foreach ($costTypes as $costType)
                    <option value="{{ $costType->id }}" {{ old('cost_type_id', $tripDetail->cost_type_id) == $costType->id ? 'selected' : '' }}>
                        {{ $costType->type_name }}
                    </option>
                @endforeach
            </select>
            @error('cost_type_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo total</label>
            <input id="cost" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror" name="cost" value="{{ old('cost', $tripDetail->cost) }}" required>
            @error('cost')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="receipt" class="block text-sm font-semibold text-gray-700 mb-2">Comprovante de gastos</label>
            <div class="flex space-x-4">
                <label for="gallery" class="flex items-center justify-center w-full py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold cursor-pointer">
                    Abrir da galeria
                    <input id="gallery" type="file" accept="image/*" class="hidden" name="receipt_gallery" onchange="handleFileSelect('gallery')">
                </label>
                <label for="camera" class="flex items-center justify-center w-full py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold cursor-pointer">
                    Tirar uma foto
                    <input id="camera" type="file" accept="image/*" capture="camera" class="hidden" name="receipt_camera" onchange="handleFileSelect('camera')">
                </label>
            </div>
            @error('receipt')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="w-full py-2 rounded-md bg-gray-800 hover:bg-gray-700 text-white font-semibold">
                Salvar
            </button>
        </div>
    </form>
</div>

<script>
    function handleFileSelect(source) {
        const galleryInput = document.getElementById('gallery');
        const cameraInput = document.getElementById('camera');
        if (source === 'gallery') {
            cameraInput.value = '';
            cameraInput.disabled = true;
            galleryInput.disabled = false;
        } else if (source === 'camera') {
            galleryInput.value = '';
            galleryInput.disabled = true;
            cameraInput.disabled = false;
        }
    }
</script>
