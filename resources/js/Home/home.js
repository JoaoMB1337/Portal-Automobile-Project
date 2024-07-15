document.addEventListener('DOMContentLoaded', function () {
    fetchChartData().then(({ vehiclesData, projectsData }) => {
        renderCharts(vehiclesData, projectsData);
    });
    // Função para abrir o modal programarViagensBtn
    document.getElementById('programarViagensBtn').addEventListener('click', function () {
        document.getElementById('program-modal').classList.remove('hidden');
    });

    // Função para abrir modal criarVeiculoBtn
    document.getElementById('criarVeiculoBtn').addEventListener('click', function () {
        document.getElementById('vehicles-modal').classList.remove('hidden');
    });
});

async function fetchChartData() {
    const response = await fetch('/fetch-data');
    const data = await response.json();
    return data;
}

function renderCharts(vehiclesData, projectsData) {
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

document.addEventListener('DOMContentLoaded', function () {
    function updateTime() {
        const timeBar = document.getElementById('time-bar');
        if (timeBar) {
            const now = new Date();
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayOfWeek = daysOfWeek[now.getDay()];
            const day = now.getDate();
            const month = now.getMonth() + 1;
            const year = now.getFullYear();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            timeBar.textContent = `${dayOfWeek}, ${day}/${month}/${year} - ${hours}:${minutes}:${seconds}`;
        }
    }

    updateTime();
    setInterval(updateTime, 1000);
});




