<div class="flex">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes da Viagem</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes Principais</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">ID</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->id }}</dd>
                    </div>
                    <!-- Adicione mais campos aqui conforme necessário -->
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Viagem</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->trip->destination }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tipo de Custo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->costType->type_name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Custo Total</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->cost }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Comprovante de Gastos</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($tripDetail->file)
                                <img src="{{ asset('storage/projects/' . $project->id . '/trips/' . $tripDetail->trip_id . '/receipts/' . $tripDetail->file) }}" alt="Comprovante de Gastos">
                            @else
                                Sem comprovante de gastos disponível.
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
