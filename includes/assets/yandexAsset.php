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
        'yandex-map-api' => 'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
        'yandex-api-on' => 'zb-y-map',
    ];
    protected $css = [
        'y' => 'zb-y-css',
    ];
}