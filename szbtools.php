<?php 
namespace szb;
/**
	* Plugin Name: SZB-Tools
	* Plugin URI: https://szb.pluginuri.com/
	* Description: Simple description of SZB-Plugin 
	* Version: 0.2.1
	* Author: Author SZB 
	* Author URI: https://szb.pluginuri.com
	* Description: and short description text
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SZBTool 
{   
    const NAME = 'szbtools';
    const PREFIX = 'szb_';
    
    private $controller;
    private static $_instance = null;
    private function __construct()
    {
        $this->defines();
        $this->includes();
        $this->init();
    }
    public static function getInstance()
    {
        if ( is_null(static::$_instance)) {
            static::$_instance = new static();
        }
        
        return static::$_instance;
    }
    private function defines()
    {
        define('SZB_DIR', WP_PLUGIN_DIR . '/'. self::NAME );
        define('SZB_URI', WP_PLUGIN_URL . '/'. self::NAME);
    }
    private function init()
    {
        $asset = 'includes';
        
        if ( is_admin() ) {
            $asset .= '/admin';
        }
        
        $path = SZB_DIR .'/' . $asset;
        $controller = $path . '/Controller.php';
        
        if( file_exists($controller) ) {
            require_once($controller);
            $this->controller = new Controller();
        }
    }
    private function includes()
    {
        require_once('includes/abstract/Asset.php');
        require_once('includes/MapModel.php');
        require_once('includes/abstract/SZBController.php');
    }
}

SZBTool::getInstance();