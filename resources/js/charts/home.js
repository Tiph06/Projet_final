import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {

    // Donut 1
    const ctxDonut1 = document.getElementById('donut1');
    if (ctxDonut1) {
        new Chart(ctxDonut1, {
            type: 'doughnut',
            data: {
                labels: ['Concernées', 'Non concernées'],
                datasets: [{
                    data: [10, 90],
                    backgroundColor: ['#f472b6', '#e5e7eb']
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom' } },
                responsive: true
            }
        });
    }

    // Donut 2
    const ctxDonut2 = document.getElementById('donut2');
    if (ctxDonut2) {
        new Chart(ctxDonut2, {
            type: 'doughnut',
            data: {
                labels: ['Retard diagnostique', 'Diagnostic précoce'],
                datasets: [{
                    data: [7, 3],
                    backgroundColor: ['#fb923c', '#e5e7eb']
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom' } },
                responsive: true
            }
        });
    }

    // Donut 3
    const ctxDonut3 = document.getElementById('donut3');
    if (ctxDonut3) {
        new Chart(ctxDonut3, {
            type: 'doughnut',
            data: {
                labels: ['Femmes atteintes', 'Population mondiale'],
                datasets: [{
                    data: [190, 7810 - 190],
                    backgroundColor: ['#60a5fa', '#e5e7eb']
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom' } },
                responsive: true
            }
        });
    }

    // Bar 1
    const ctxBar1 = document.getElementById('bar1');
    if (ctxBar1) {
        new Chart(ctxBar1, {
            type: 'bar',
            data: {
                labels: ['Nord', 'Sud', 'Est', 'Ouest'],
                datasets: [{
                    label: 'Cas (%)',
                    data: [30, 25, 20, 25],
                    backgroundColor: '#f472b6'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                responsive: true
            }
        });
    }

    // Bar 2
    const ctxBar2 = document.getElementById('bar2');
    if (ctxBar2) {
        new Chart(ctxBar2, {
            type: 'bar',
            data: {
                labels: ['Péritonéale', 'Ovarienne', 'Profonde'],
                datasets: [{
                    label: 'Répartition',
                    data: [40, 35, 25],
                    backgroundColor: '#facc15'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                responsive: true
            }
        });
    }

    // Bar 3
    const ctxBar3 = document.getElementById('bar3');
    if (ctxBar3) {
        new Chart(ctxBar3, {
            type: 'bar',
            data: {
                labels: ['15-25 ans', '26-35 ans', '36-45 ans'],
                datasets: [{
                    label: 'Répartition',
                    data: [20, 50, 30],
                    backgroundColor: '#5ba3c1'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                responsive: true
            }
        });
    }

});
