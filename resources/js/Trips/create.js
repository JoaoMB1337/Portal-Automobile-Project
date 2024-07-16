document.addEventListener('DOMContentLoaded', function() {
    const vehicles = JSON.parse(document.getElementById('vehicles-data').textContent);

    document.getElementById('search_vehicle').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const selectElement = document.getElementById('vehicle_id');

        selectElement.innerHTML = '<option value="" disabled selected>Selecione um veículo</option>';

        let foundMatch = false;

        vehicles.forEach(vehicle => {
            if (vehicle.plate.toLowerCase().includes(searchValue)) {
                const option = document.createElement('option');
                option.value = vehicle.id;
                option.text = vehicle.plate;
                selectElement.appendChild(option);

                if (!foundMatch) {
                    selectElement.value = vehicle.id;
                    foundMatch = true;
                }
            }
        });

        if (!foundMatch) {
            selectElement.value = "";
        }
    });

    document.getElementById('start_date').addEventListener('change', validateVehicleAvailability);
    document.getElementById('end_date').addEventListener('change', validateVehicleAvailability);
    document.getElementById('vehicle_id').addEventListener('change', validateVehicleAvailability);

    function validateVehicleAvailability() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const vehicleId = document.getElementById('vehicle_id').value;

        if (startDate && endDate && vehicleId) {
            fetch(`/api/check-vehicle-availability?start_date=${startDate}&end_date=${endDate}&vehicle_id=${vehicleId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.available) {
                        document.getElementById('vehicle-error').innerText = 'O veículo já está em uso durante o período selecionado.';
                        document.getElementById('submit-button').disabled = true;
                    } else {
                        document.getElementById('vehicle-error').innerText = '';
                        document.getElementById('submit-button').disabled = false;
                    }
                });
        }
    }

    document.getElementById('trip-form').addEventListener('submit', function(event) {
        if (document.getElementById('vehicle-error').innerText) {
            event.preventDefault();
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const employees = JSON.parse(document.getElementById('employees-data').textContent);

    document.getElementById('employee_name').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const selectElement = document.getElementById('employee_id');

        selectElement.innerHTML = '<option value="" disabled selected>Selecione um funcionário</option>';

        let foundMatch = false;

        employees.forEach(employee => {
            if (employee.name.toLowerCase().includes(searchValue)) {
                const option = document.createElement('option');
                option.value = employee.id;
                option.text = employee.name;
                selectElement.appendChild(option);

                if (!foundMatch) {
                    selectElement.value = employee.id;
                    foundMatch = true;
                }
            }
        });

        if (!foundMatch) {
            selectElement.value = "";
        }
    });

    document.getElementById('trip-form').addEventListener('submit', function(event) {
        if (document.getElementById('employee-error').innerText) {
            event.preventDefault();
        }
    });
});
