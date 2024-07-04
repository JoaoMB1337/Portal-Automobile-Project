<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center md:col-span-1">
        <div class="w-full">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Veículos</h2>
            <canvas id="vehiclesChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-sm md:col-span-2">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Projetos</h2>
        <canvas id="projectsChart" class="w-full h-full"></canvas>
    </div>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm mt-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Seguros a Terminar</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matricula</th>
                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Companhia</th>
                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número da Apólice</th>
                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Expiração</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($endingInsurances as $insurance)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->vehicle->plate }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->insurance_company }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->policy_number }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->end_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 whitespace-nowrap text-center text-lg font-medium text-gray-500">Nenhum seguro a terminar.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $endingInsurances->links() }}
        </div>
    </div>
</div>
