//var coords = [54.812953, 72.884675];// Омск
//var coords = [55.76, 37.64]; // МСК

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
            
            console.log([coords, zoom, ID]);
        }
    }
});
