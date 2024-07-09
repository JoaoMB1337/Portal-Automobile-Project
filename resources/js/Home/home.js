document.addEventListener('DOMContentLoaded', function () {
    fetchChartData().then(({ vehiclesData, projectsData }) => {
        renderCharts(vehiclesData, projectsData);
    });
});

async function fetchChartData() {
    const response = await fetch('/fetch-data');
    const data = await response.json();
    return data;
}

function renderCharts(vehiclesData, projectsData) {
    // Verificar se não há veículos internos ou externos e ajustar os dados e cores
    let vehicleLabels = ['Internos', 'Externos'];
    let vehicleData = [vehiclesData.internal, vehiclesData.external];
    let vehicleColors = ['#37afa5', '#1b3342'];

    if (vehiclesData.internal === 0 && vehiclesData.external === 0) {
        vehicleLabels = ['Sem Veículos'];
        vehicleData = [1]; 
        vehicleColors = ['#cccccc'];  
    }

    const ctxVehicles = document.getElementById('vehiclesChart').getContext('2d');
    new Chart(ctxVehicles, {
        type: 'pie',
        data: {
            labels: vehicleLabels,
            datasets: [{
                data: vehicleData,
                backgroundColor: vehicleColors
            }]
        }
    });

    const ctxProjects = document.getElementById('projectsChart').getContext('2d');
    new Chart(ctxProjects, {
        type: 'bar',
        data: {
            labels: ['Não Iniciado', 'Em Progresso', 'Concluído', 'Cancelado', 'Em Espera'],
            datasets: [{
                label: 'Projetos',
                data: [
                    projectsData.notStarted,
                    projectsData.inProgress,
                    projectsData.completed,
                    projectsData.cancelled,
                    projectsData.onHold
                ],
                backgroundColor: [
                    '#1b3342',
                    '#36A2EB',
                    '#37afa5',
                    '#c1c3c6',
                    '#f83038'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}
