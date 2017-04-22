<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class yandexAsset extends Asset
{
    protected $jsf = '/assets/js/';
    protected $cssf = '/assets/css/';
    protected $view = 'szbview-y';
    
    
    protected $js = [
        'map-api' => 'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
        'map-api-on' => 'zb-y-map',
    ];
    protected $css = [
        'zb-y-css',
    ];
}