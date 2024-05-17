<div class="flex">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes do Veículo</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes Principais</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Matrícula</dt>
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
                        <dt class="text-sm font-medium text-gray-500">Tipo de combustível</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->fuelType->type }}</dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">É externo?</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($vehicle->is_external)
                                Sim
                            @else
                                Não
                            @endif
                        </dd>
                    </div>

                    @if($vehicle->is_external)
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Contrato</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->contract_number }}</dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Data de Início do Aluguer</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_start_date }}</dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Data de Fim do Aluguer</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_end_date }}</dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Valor do Aluguer por dia</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_price_per_day }}</dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Empresa de RentCar</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_company }}</dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Pessoa Responsavel da RentCar</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_contact_person }}</dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500"> Contacto da RentCar</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_contact_number }}</dd>
                        </div>

                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">PDF</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                    <a href="{{ route('vehicles.downloadPdf', $vehicle) }}">Download PDF</a>
                                </dd>
                            </div>




                    @endif


                </dl>
            </div>
        </div>
    </div>
</div>
