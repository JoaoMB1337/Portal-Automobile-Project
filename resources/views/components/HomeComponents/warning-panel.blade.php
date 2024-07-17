<div class="bg-yellow-50 rounded-lg border border-yellow-300 p-4 shadow-sm">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Viagens que terminam hoje</h2>
    <a href="{{ url('trips?destination=&project=&start_date=&end_date=&trips_ending_today=on') }}">
        <h2 class="text-center text-3xl font-bold text-red-700">{{ $tripsEndingToday }}</h2>
    </a>
    <hr class="my-4 border-yellow-300">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Seguros a terminar em 30 dias</h2>
    <a href="{{ url('insurances?insurance_company=&policy_number=&terminando=on') }}">
        <h2 class="text-center text-3xl font-bold text-red-700">{{ $insurancesEndingToday }}</h2>
    </a>
</div>