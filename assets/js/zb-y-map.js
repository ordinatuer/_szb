ymaps.ready(function(){
    var coords, zoom, ID, map, pm;
    for (k in ZB) {
        if('yandex' == ZB[k]['vendor']) {
            coords = [+ZB[k]['lon'], +ZB[k]['lat']];
            zoom = +ZB[k]['zoom'];
            ID = k;
            
            map = new ymaps.Map(k, {
                center: coords,
                zoom: zoom
            });
            
            if ( ZB[k]['header'] && ZB[k]['content'] ) {
                pm = new ymaps.Placemark(coords, {
                    hintContent: ZB[k]['header'],
                    balloonContent: ZB[k]['content']
                });
                
                map.geoObjects.add(pm);
            }
        }
    }
});