<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="main">
    <div class="flex justify-between items-center mb-4">
        @auth
            <a href="{{ route('vehicles.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Add Vehicle</a>
        @endauth
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                @auth
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                @endauth
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->brand }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->model }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->year }}</td>
                    @auth
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="text-blue-600 hover:underline">Show</a>
                            <a href="{{ route('vehicles.edit', $vehicle) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                            </form>
                        </td>
                    @endauth
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">No vehicles found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if (!$vehicles->isEmpty())
        {{ $vehicles->links() }}
    @endif
</div>
