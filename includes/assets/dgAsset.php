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
        'dg-map-api' => 'http://maps.api.2gis.ru/2.0/loader.js?pkg=basic',
        'dg-api-on' => 'zb-dg-map',
    ];
    protected $css = [
        'dg' => 'zb-dg-styles',
    ];
}