// Coordenadas iniciales
var lat = -28.47326;
var lon = -65.78756;
//inicializa mapa con centro del mapa con coordenadas iniciales y zoom de 17 en DIV mapid
var map = L.map('map').setView([lat, lon], 17);
//Indica que Tile se utilizará
/* L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map); */


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

}).addTo(map);

document.getElementById("lat").value = lat;
document.getElementById("lon").value = lon;

L.marker([lat, lon], { draggable: true }).on('dragend', markerOnClick).addTo(map);

function markerOnClick(e) {
    //Mover marcador donde se arrastre
    dragLat = e.target._latlng.lat;
    dragLon = e.target._latlng.lng;
    // Mostrar en inputs
    document.getElementById("lat").value = dragLat.toFixed(5);
    document.getElementById("lon").value = dragLon.toFixed(5);
}