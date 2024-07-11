<div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Veiculos em uso</h2>
    <a href="{{ url('vehicles?search=&is_external=&fuel_type=&filter_activity=1') }}">
        <h2 class="text-center text-3xl font-bold text-green-600">{{ $vehicleActive }}</h2>
    </a>
    <hr class="my-4">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Veiculos sem uso</h2>
    <a href="{{ url('vehicles?search=&is_external=&fuel_type=&filter_activity=0') }}">
        <h2 class="text-center text-3xl font-bold text-red-600">{{ $vehicleInactive }}</h2>
    </a>
</div>
