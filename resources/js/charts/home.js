import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    const ctxDonut = document.getElementById('myDonut');
    if (ctxDonut) {
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    data: [30, 50, 20],
                    backgroundColor: ['#f472b6', '#fbbf24', '#60a5fa'],
                }]
            }
        });
    }

    const ctxBar = document.getElementById('myBar');
    if (ctxBar) {
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar'],
                datasets: [{
                    label: 'Ventes',
                    data: [12, 19, 3],
                    backgroundColor: '#34d399',
                }]
            }
        });
    }
});
