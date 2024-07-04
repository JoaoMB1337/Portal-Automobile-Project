<!-- resources/views/modal-viagens-employee.blade.php -->

<div id="trip-modal" class="fixed inset-0 z-50 hidden overflow-y-auto lg:pl-64">
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Detalhes da Viagem
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="trip-details">
                                <!-- Conteúdo dos detalhes da viagem será injetado aqui -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm" onclick="document.getElementById('trip-modal').classList.add('hidden')">
                    Fechar
                </button>
                <a id="add-cost-button" href="#" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-gray-500 text-base font-medium text-white hover:bg-gray-600 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                    Adicionar Custo
                </a>
                <a id="maps-button" href="#" target="_blank" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                    Abrir no Google Maps
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function showTripDetails(tripId, startDate, endDate, destination) {
        // Define os detalhes da viagem no modal
        const tripDetails = `
            <p><strong>Data de Início:</strong> ${startDate}</p>
            <p><strong>Data de Término:</strong> ${endDate}</p>
            <p><strong>Destino:</strong> ${destination}</p>
        `;
        document.getElementById('trip-details').innerHTML = tripDetails;

        // Atualiza o link do botão "Adicionar Custo"
        document.getElementById('add-cost-button').href = `/trip-details/create?trip_id=${tripId}`;

        // Atualiza o link do botão "Abrir no Google Maps"
        const mapsLink = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(destination)}`;
        document.getElementById('maps-button').href = mapsLink;

        // Mostra o modal
        document.getElementById('trip-modal').classList.remove('hidden');
    }
</script>
