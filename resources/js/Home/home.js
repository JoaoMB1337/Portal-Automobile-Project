document.addEventListener('DOMContentLoaded', function () {
    fetchChartData().then(({ vehiclesData, projectsData }) => {
        renderCharts(vehiclesData, projectsData);
    });

    let projectId = '';
    let vehicleId = '';

    // Função para abrir o modal de projetos
    document.getElementById('create-project').addEventListener('click', function () {
        document.getElementById('project-modal').classList.remove('hidden');
    });


    // Função para abrir o modal de veículos
    document.getElementById('next-create-vehicle').addEventListener('click', function () {
        document.getElementById('project-modal').classList.add('hidden');
        document.getElementById('vehicles-modal').classList.remove('hidden');
    });

    // Função para abrir o modal de viagens
    document.getElementById('next-create-trip').addEventListener('click', function () {
        document.getElementById('vehicles-modal').classList.add('hidden');
        document.getElementById('trip-modal').classList.remove('hidden');
    });

    // Fechar modais
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = button.getAttribute('data-modal');
            document.getElementById(modalId).classList.add('hidden');
        });
    });
});

function closeProjectModal() {
    document.getElementById('project-modal').classList.add('hidden');
}

function closeVehicleModal() {
    document.getElementById('vehicles-modal').classList.add('hidden');
}

function closeTripModal() {
    document.getElementById('trip-modal').classList.add('hidden');
}

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

    function atualizarDataHora() {

        const diasSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];

        const dataAtual = new Date();

        const dataFormatada = `${("0" + dataAtual.getDate()).slice(-2)}/${("0" + (dataAtual.getMonth() + 1)).slice(-2)}/${dataAtual.getFullYear()}`;

        const diaSemana = diasSemana[dataAtual.getDay()];

        const horaAtual = `${("0" + dataAtual.getHours()).slice(-2)}:${("0" + dataAtual.getMinutes()).slice(-2)}:${("0" + dataAtual.getSeconds()).slice(-2)}`;

        const conteudoHTML = `
            <p>${horaAtual}</p>
            <p>${diaSemana}, ${dataFormatada}</p>
        `;

        document.getElementById("datetimeContainer").innerHTML = conteudoHTML;
    }

    atualizarDataHora();

    setInterval(atualizarDataHora, 1000);
}
