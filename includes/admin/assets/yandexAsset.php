<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class yandexAsset extends Asset
{
    protected $jsf = '/assets/admin/js/';
    protected $cssf = '/assets/admin/css/';
    protected $view = 'yandex-admin';
    
    
    protected $js = [
        'map-api' => 'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
        'map-api-on' => 'yandex-js',
    ];
    protected $css = [
        'style',
    ];
}