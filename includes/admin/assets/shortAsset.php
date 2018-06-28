<?php
namespace szb;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class shortAsset extends Asset
{
    protected $jsf = '/assets/admin/js/';
    protected $cssf = '/assets/admin/css/';
    protected $view = 'short';
    
    protected $js = [
        'short-js',
    ];
    protected $css = [
        'short',
    ];
}