import Chart from 'chart.js/auto';

// Options communes
const baseOptions = {
    responsive: true,
    maintainAspectRatio: false
};

// Palette cohérente
const PP = {
    fuchsia: '#E91E63',
    poudre:  '#F8E9EF',
    encre:   '#1F2A44',
    gris2:   '#CBD5E1'
};

const TYPO = {
    family: 'Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif',
    axis:   16,
    legend: 16,
    tip:    16,
    tipT:   15
};

// Defaults Chart.js
Chart.defaults.font.family = TYPO.family;
Chart.defaults.font.size   = 13;
Chart.defaults.color = '#334155';
if (!Chart.defaults.scale) Chart.defaults.scale = {};
if (!Chart.defaults.scale.ticks) Chart.defaults.scale.ticks = {};
Chart.defaults.scale.ticks.font  = { size: 13, weight: '500', family: TYPO.family };
Chart.defaults.scale.ticks.color = '#334155';

// Les datasets
const regions = { labels: ['Île-de-France','AURA','PACA','Occitanie'], data: [24,18,14,12] };
const formes  = { labels: ['Superficielle','Ovarienne','Profonde'],   data: [45,30,25] };
const ages    = { labels: ['<20','20-29','30-39','40+'],              data: [8,32,38,22] };
const oneInTen = { labels: ['Concernée','Non concernée'],             data: [10,90] };
const delay    = { labels: ['<2 ans','2-5 ans','5-7 ans','>7 ans'],   data: [15,30,25,30] };
const world    = { labels: ['Cas (monde)'],                           data: [190] };

// Palette commune
const chartPalette = [
    PP.fuchsia,
    '#FBCFE8',
    '#93C5FD',
    '#FDE68A',
    '#A7F3D0'
];

// Helpers inchangés, mais uniformisés pour barres multicolores
function donutDataFrom(obj) {
    return {
        labels: obj.labels,
        datasets: [{
            data: obj.data,
            backgroundColor: chartPalette.slice(0, obj.data.length),
            borderColor: '#fff',
            borderWidth: 2
        }]
    };
}

// Multicolore si >1 data, sinon fuchsia
function barDataFrom(obj, label = '') {
    let colors = obj.data.length > 1
        ? chartPalette.slice(0, obj.data.length)
        : [PP.fuchsia];
    return {
        labels: obj.labels,
        datasets: [{
            label: label || 'Valeurs',
            data: obj.data,
            backgroundColor: colors,
            borderRadius: 8
        }]
    };
}

const donutOptions = {
    ...baseOptions,
    cutout: '68%',
    radius: '92%',
    plugins: {
        legend: {
            position: 'bottom',
            labels: {
                usePointStyle: true,
                pointStyle: 'rectRounded',
                boxWidth: 12,
                boxHeight: 10,
                padding: 12,
                font: { size: TYPO.legend, weight: '600', family: TYPO.family },
                color: PP.encre
            }
        }
    },
    tooltip: {
        titleFont: { size: TYPO.tipT, family: TYPO.family },
        bodyFont:  { size: TYPO.tip,  family: TYPO.family }
    },
    elements: { arc: { hoverOffset: 4, borderWidth: 2, borderColor: '#fff' } }
};

function shortenLabel(label, max = 12) {
    const s = String(label);
    return s.length > max ? s.slice(0, max - 1) + '…' : s;
}

const barOptions = {
    ...baseOptions,
    plugins: {
        legend: { display: false },
        tooltip: {
            titleFont: { size: TYPO.tipT, family: TYPO.family },
            bodyFont:  { size: TYPO.tip,  family: TYPO.family }
        }
    },
    scales: {
        x: {
            ticks: {
                font:   { size: 14, weight: '600', family: TYPO.family },
                color:  PP.encre,
                padding: 8,
                maxRotation: 0,
                autoSkip: false
            },
            grid: { display: false }
        },
        y: {
            beginAtZero: true,
            ticks: {
                font:   { size: 13, family: TYPO.family },
                color:  '#64748b',
                padding: 6
            },
            grid: { color: PP.gris2 }
        }
    }
};

function addDonutShadow(canvas) {
    if (canvas) canvas.classList.add('donut-shadow');
}

function initCharts() {
    // DONUTS dans bar1-bar2-bar3 (datasets swapés)
    const cBar1 = document.getElementById('bar1');
    if (cBar1) { new Chart(cBar1, { type: 'doughnut', data: donutDataFrom(regions), options: donutOptions }); addDonutShadow(cBar1); }
    const cBar2 = document.getElementById('bar2');
    if (cBar2) { new Chart(cBar2, { type: 'doughnut', data: donutDataFrom(formes),  options: donutOptions }); addDonutShadow(cBar2); }
    const cBar3 = document.getElementById('bar3');
    if (cBar3) { new Chart(cBar3, { type: 'doughnut', data: donutDataFrom(ages),    options: donutOptions }); addDonutShadow(cBar3); }
    // BARRES dans donut1-donut2-donut3 (datasets swapés)
    const cDonut1 = document.getElementById('donut1');
    if (cDonut1) new Chart(cDonut1, { type: 'bar', data: barDataFrom(oneInTen, '1 femme sur 10'), options: barOptions });
    const cDonut2 = document.getElementById('donut2');
    if (cDonut2) new Chart(cDonut2, { type: 'bar', data: barDataFrom(delay, 'Retard de diagnostic'), options: barOptions });
    const cDonut3 = document.getElementById('donut3');
    if (cDonut3) new Chart(cDonut3, { type: 'bar', data: barDataFrom(world, 'Cas dans le monde (M)'), options: barOptions });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCharts);
} else {
    initCharts();
}
