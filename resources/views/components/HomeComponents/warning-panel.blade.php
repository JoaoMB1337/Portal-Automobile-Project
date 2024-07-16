<div class="bg-yellow-50 rounded-lg border border-yellow-300 p-4 shadow-sm">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Viagens que terminam hoje</h2>
    <a href="{{ url('trips?destination=&project=&start_date=&end_date=&insurance_ends_today=on') }}">
        <h2 class="text-center text-3xl font-bold text-red-700">{{ $tripsEndingToday }}</h2>
    </a>
    <hr class="my-4 border-yellow-300">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Seguros que terminam hoje</h2>
    <a href="{{ url('insurances?insurance_company=&policy_number=&ending_today=on') }}">
        <h2 class="text-center text-3xl font-bold text-red-700">{{ $insurancesEndingToday }}</h2>
    </a>
</div>
