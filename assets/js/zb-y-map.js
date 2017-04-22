//var coords = [54.812953, 72.884675];// Омск
var coords = [55.76, 37.64]; // МСК

if ( SZB.lon && SZB.lat ) {
    coords[0] = SZB.lon;
    coords[1] = SZB.lat;
}
    

ymaps.ready(function() {
    new ymaps.Map("yMap", {
        center: coords,
        zoom: SZB.zoom
    });
});