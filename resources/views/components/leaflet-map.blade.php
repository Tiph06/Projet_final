@props([
'centres' => [], // liste des centres passée depuis la page/contrôleur
'height' => 'h-96', // hauteur Tailwind personnalisable
'id' => 'map-centres', // id unique si tu en mets plusieurs
])

<div id="{{ $id }}" {{ $attributes->merge(['class' => "w-full rounded-xl $height"]) }}></div>


@once
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initLeaflet() {
            if (!window.L) return requestAnimationFrame(initLeaflet);
            // eslint-disable-next-line
            // const centres = @json($centres); // <--- ici visual code ne reconnait pas la syntaxe mais cela fonctionne quand meme 
            const centres = JSON.parse('{!! json_encode($centres) !!}'); // <--- ici l'éditeur voit une vraie chaîne JS



            const map = L.map('{{ $id }}').setView([46.6, 2.2], 6);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Icône personnalisée
            const customIcon = L.icon({
                iconUrl: '/images/hopital.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            const markers = [];
            (centres || []).forEach(c => {
                if (Array.isArray(c.coords) && c.coords.length === 2) {
                    const m = L.marker(c.coords, {
                            icon: customIcon
                        })
                        .addTo(map)
                        .bindPopup(`<strong>${c.name ?? 'Centre spécialisé'}</strong>`);
                    markers.push(m);
                }
            });

            if (markers.length) {
                const group = L.featureGroup(markers);
                map.fitBounds(group.getBounds(), {
                    padding: [30, 30]
                });
            }
        }

        initLeaflet();
    });
</script>
@endpush
@endonce