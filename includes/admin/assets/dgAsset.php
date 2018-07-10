<?php
namespace szb;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class dgAsset extends Asset
{
    protected $jsf = '/assets/admin/js/';
    protected $cssf = '/assets/admin/css/';
    protected $view = 'dg-admin';
    
    protected $js = [
        'map-api' => 'http://maps.api.2gis.ru/2.0/loader.js?pkg=full',
        'dg-js',
    ];
    protected $css = [
        'style',
    ];
}