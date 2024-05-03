<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Edit Vehicle - ID: {{ $vehicle->id }}</h1>
    <form method="post" action="{{ route('vehicles.update', $vehicle) }}" class="max-w-md mx-auto">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" value="{{ $vehicle->name }}">
        </div>

        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <input type="text" class="form-input mt-1 block w-full" id="brand" name="brand" value="{{ $vehicle->brand }}">
        </div>

        <div class="mb-4">
            <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
            <input type="text" class="form-input mt-1 block w-full" id="model" name="model" value="{{ $vehicle->model }}">
        </div>

        <div class="mb-4">
            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
            <input type="text" class="form-input mt-1 block w-full" id="year" name="year" value="{{ $vehicle->year }}">
        </div>

        <div class="mb-4">
            <label for="created_at" class="block text-sm font-medium text-gray-700">Created at</label>
            <input type="text" class="form-input mt-1 block w-full" id="created_at" name="created_at" value="{{ $vehicle->created_at }}" disabled>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            <a href="{{ route('vehicles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
        </div>
    </form>
</div>
