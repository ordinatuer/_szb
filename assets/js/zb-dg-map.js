//var coords = [54.812953, 72.884675];// Омск
var coords = [55.76, 37.64]; // МСК

if ( SZB.lon && SZB.lat ) {
    coords[0] = SZB.lon;
    coords[1] = SZB.lat;
}

DG.then(function () {
    map = DG.map('dgMap', {
        center: coords,
        zoom: SZB.zoom
    });

    DG.marker(coords).addTo(map);
});