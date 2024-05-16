<div class="flex">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes do Veiculo</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes Principais</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Matricula</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->plate }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Marca</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->brand->name }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Categoria</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->carCategory->category }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tipo de combustivel</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->fuelType->type }}</dd>
                    </div>


                </dl>
            </div>
        </div>
    </div>
</div>
