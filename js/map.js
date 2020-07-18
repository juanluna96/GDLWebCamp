var regalo = document.getElementById('regalo');
var map = L.map('mapa').setView([8.758336, -75.895218], 16);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([8.758336, -75.895218]).addTo(map)
    .bindPopup('<b>GDLWebCamp 2020.</b><br> Boletos ya disponibles.')
    .openPopup();