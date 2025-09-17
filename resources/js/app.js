import './charts/home.js';

// Tailwind & scripts perso (si déjà présents)
import '../css/app.css';

//  Alpine (plus de CDN)
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

//  Chart.js (auto-register)
import Chart from 'chart.js/auto';
window.Chart = Chart;

//  Leaflet (JS + CSS)
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
window.L = L;

// Fix des icônes Leaflet (sinon marqueurs invisibles avec Vite)
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png';
import iconUrl       from 'leaflet/dist/images/marker-icon.png';
import shadowUrl     from 'leaflet/dist/images/marker-shadow.png';

L.Icon.Default.mergeOptions({
    iconRetinaUrl,
    iconUrl,
    shadowUrl,
});
