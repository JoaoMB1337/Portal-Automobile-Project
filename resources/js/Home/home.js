// home.js

document.addEventListener('DOMContentLoaded', function () {
    fetchChartData().then(({vehiclesData, projectsData}) => {
        renderCharts(vehiclesData, projectsData);
    });
});

async function fetchChartData() {
    // Considerando que os dados podem ser obtidos via API ou outra fonte
    return {
        vehiclesData: {
            internal: 10, // Valor exemplo
            external: 5  // Valor exemplo
        },
        projectsData: {
            notStarted: 4,
            inProgress: 10,
            completed: 7,
            cancelled: 2,
            onHold: 1
        }
    };
}

function renderCharts(vehiclesData, projectsData) {
    const ctxVehicles = document.getElementById('vehiclesChart').getContext('2d');
    new Chart(ctxVehicles, {
        type: 'pie',
        data: {
            labels: ['Internos', 'Externos'],
            datasets: [{
                data: [vehiclesData.internal, vehiclesData.external],
                backgroundColor: ['#37afa5', '#1b3342']
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
