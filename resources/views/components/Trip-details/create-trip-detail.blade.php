<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Detalhe de Viagem</title>
    <!-- Inclua aqui os estilos do Tailwind ou outros estilos -->
</head>
<body>
    <div class="mt-8">
        <form method="POST" action="{{ route('trip-details.store') }}" enctype="multipart/form-data"
            class="space-y-10 bg-white p-6 rounded-lg shadow-md" onsubmit="disableSubmitButton(event)">
            @csrf

            <div class="flex items-center justify-between mb-6">
                @include('components.ButtonComponents.backButton')
                <div class="flex-grow text-center">
                    <h1 class="text-lg leading-6 font-medium text-gray-900">Criar detalhe de viagem</h1>
                </div>
                <div class="w-10 h-10"></div>
            </div>
            
            <div>
                <label for="trip_id" class="block text-sm font-semibold text-gray-700 mb-2">Viagem</label>
                <select name="trip_id" id="trip_id"
                    class="form-select w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('trip_id') border-red-500 @enderror"
                    required {{ isset($tripId) ? 'disabled' : '' }}>
                    <option value="">Selecione a viagem</option>
                    @foreach ($trips as $trip)
                        <option value="{{ $trip->id }}" {{ old('trip_id', isset($tripId) ? $tripId : '') == $trip->id ? 'selected' : '' }}>
                            {{ $trip->destination }}</option>
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
                <select name="cost_type_id" id="cost_type_id"
                    class="form-select w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost_type_id') border-red-500 @enderror"
                    required>
                    <option value="">Selecione o tipo de custo</option>
                    @foreach ($costTypes as $costType)
                        <option value="{{ $costType->id }}" {{ old('cost_type_id') == $costType->id ? 'selected' : '' }}>
                            {{ $costType->type_name }}</option>
                    @endforeach
                </select>
                @error('cost_type_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo total</label>
                <input id="cost" type="text"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror"
                    name="cost" value="{{ old('cost') }}" required>
                @error('cost')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="receipt" class="block text-sm font-semibold text-gray-700 mb-2">Comprovante de gastos</label>
                <div id="file-upload-options" class="flex space-x-4">
                    <label id="gallery-label"
                        class="flex items-center justify-center w-full py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold cursor-pointer">
                        Abrir da galeria
                        <input id="gallery" type="file" accept="image/*" class="hidden" name="receipt_gallery"
                            onchange="handleFileSelect('gallery')">
                    </label>
                    <label id="camera-label"
                        class="flex items-center justify-center w-full py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold cursor-pointer">
                        Tirar uma foto
                        <input id="camera" type="file" accept="image/*" capture="camera" class="hidden" name="receipt_camera"
                            onchange="handleFileSelect('camera')">
                    </label>
                </div>
                @error('receipt')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" id="submit-button"
                    class="py-2 px-4 rounded-md bg-gray-800 hover:bg-gray-700 text-white font-semibold">
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

        //check se esta num computador ou telemovel
        function detectDeviceAndAdjustOptions() {
            const isMobile = /Mobi|Android/i.test(navigator.userAgent);
            const galleryLabel = document.getElementById('gallery-label');
            const cameraLabel = document.getElementById('camera-label');

            if (isMobile) {
                galleryLabel.style.display = 'flex';
                cameraLabel.style.display = 'flex';
            } else {
                galleryLabel.style.display = 'flex';
                cameraLabel.style.display = 'none';
            }
        }
        function disableSubmitButton() {
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = true;
            submitButton.innerText = 'Aguarde...';
        }
        document.addEventListener('DOMContentLoaded', detectDeviceAndAdjustOptions);
    </script>
</body>
</html>
