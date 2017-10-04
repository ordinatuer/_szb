DG.then(function(){
    var coords, zoom, ID;
    
    for(k in ZB) {
        if('dg' == ZB[k]['vendor']) {
            coords = [+ZB[k]['lon'], +ZB[k]['lat']];
            zoom = +ZB[k]['zoom'];
            ID = k;
            
            map = DG.map(ID, {
                center: coords,
                zoom: 15
            });
            
            if ( ZB[k]['header'] && ZB[k]['content'] ) {
                DG.marker(coords,{
                    title: ZB[k]['header']
                })
                .addTo(map)
                .bindPopup(ZB[k]['content']);
            }
        }
    }
});
