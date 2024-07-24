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
                            Detalhes da viagem
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="trip-details">
                                <!-- Detalhes da viagem serão injetados aqui -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 flex flex-col gap-3 sm:flex-row sm:gap-4">
                <a id="maps-button" href="#" target="_blank"
                    class="w-full sm:w-auto px-2 py-2 inline-flex justify-center rounded-md border border-gray-300 shadow-sm bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none sm:mt-0 sm:text-sm">
                    Abrir no Maps
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="27" height="27" viewBox="0 0 48 48">
                        <path fill="#48b564" d="M35.76,26.36h0.01c0,0-3.77,5.53-6.94,9.64c-2.74,3.55-3.54,6.59-3.77,8.06 C24.97,44.6,24.53,45,24,45s-0.97-0.4-1.06-0.94c-0.23-1.47-1.03-4.51-3.77-8.06c-0.42-0.55-0.85-1.12-1.28-1.7L28.24,22l8.33-9.88 C37.49,14.05,38,16.21,38,18.5C38,21.4,37.17,24.09,35.76,26.36z"></path>
                        <path fill="#fcc60e" d="M28.24,22L17.89,34.3c-2.82-3.78-5.66-7.94-5.66-7.94h0.01c-0.3-0.48-0.57-0.97-0.8-1.48L19.76,15 c-0.79,0.95-1.26,2.17-1.26,3.5c0,3.04,2.46,5.5,5.5,5.5C25.71,24,27.24,23.22,28.24,22z"></path>
                        <path fill="#2c85eb" d="M28.4,4.74l-8.57,10.18L13.27,9.2C15.83,6.02,19.69,4,24,4C25.54,4,27.02,4.26,28.4,4.74z"></path>
                        <path fill="#ed5748" d="M19.83,14.92L19.76,15l-8.32,9.88C10.52,22.95,10,20.79,10,18.5c0-3.54,1.23-6.79,3.27-9.3 L19.83,14.92z"></path>
                        <path fill="#5695f6" d="M28.24,22c0.79-0.95,1.26-2.17,1.26-3.5c0-3.04-2.46-5.5-5.5-5.5c-1.71,0-3.24,0.78-4.24,2L28.4,4.74 c3.59,1.22,6.53,3.91,8.17,7.38L28.24,22z"></path>
                    </svg>
                </a>

                <a id="add-cost-button" href="#"
                    class="w-full sm:w-auto px-2.5 py-2.5 inline-flex justify-center rounded-md border border-gray-300 shadow-sm bg-gray-500 text-base font-medium text-white hover:bg-gray-600 focus:outline-none sm:mt-0 sm:text-sm">
                    Adicionar custo
                </a>

                <button type="button"
                    class="w-full sm:w-auto px-2.5 py-2.5 inline-flex justify-center rounded-md border border-gray-300 shadow-sm bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:text-sm"
                    onclick="document.getElementById('trip-modal').classList.add('hidden')">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showTripDetails(tripId, startDate, endDate, destination, plate, country, district) {
        const tripDetails = `
        <p><strong>Data de Início:</strong> ${startDate}</p>
        <p><strong>Data de Término:</strong> ${endDate}</p>
        <p><strong>Destino:</strong> ${destination}</p>
        <p><strong>Matrícula:</strong> ${plate}</p>
        <p><strong>País:</strong> ${country}</p>
        <p><strong>Distrito:</strong> ${district}</p>
    `;
        document.getElementById('trip-details').innerHTML = tripDetails;

        document.getElementById('add-cost-button').href = `/trip-details/create?trip_id=${tripId}`;

        const mapsLink =
            `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(destination + ', ' + district + ', ' + country)}`;
        document.getElementById('maps-button').href = mapsLink;

        document.getElementById('trip-modal').classList.remove('hidden');
    }
</script>
