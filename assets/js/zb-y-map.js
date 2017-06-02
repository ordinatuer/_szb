ymaps.ready(function(){
    var coords, zoom, ID;
    for (k in ZB) {
        if('yandex' == ZB[k]['vendor']) {
            coords = [+ZB[k]['lon'], +ZB[k]['lat']];
            zoom = +ZB[k]['zoom'];
            ID = k;
            
            new ymaps.Map(k, {
                center: coords,
                zoom: zoom
            });
        }
    }
});