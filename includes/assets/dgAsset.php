<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class dgAsset extends Asset
{
    protected $jsf = '/assets/js/';
    protected $cssf = '/assets/css/';
    protected $view = 'zbview-2';
    
    protected $js = [
        'map-api' => 'http://maps.api.2gis.ru/2.0/loader.js?pkg=full',
        'zb-dg-map',
    ];
    protected $css = [
        'zb-dg-styles',
    ];
}