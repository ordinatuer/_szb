<?php 

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
    
    private $controller;
    private static $_instance = null;
    private function __construct()
    {
        //$this->defines();
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
        //define('SZB_DIR', plugin_dir_path(__FILE__));
        //define('SZB_URI', plugin_dir_url(__FILE__));
    }
    private function init()
    {
        $asset = 'includes';
        
        if ( is_admin() ) {
            $asset .= '/admin';
        }
        
        $path = WP_PLUGIN_DIR . '/' . self::NAME .'/' . $asset;
        $controller = $path . '/Controller.php';
        
        require_once($controller);
        
        $this->controller = new Controller();
        
    }
    private function includes()
    {
        require_once('includes/abstract/Asset.php');
        require_once('includes/MapModel.php');
        require_once('includes/abstract/SZBController.php');
    }
}

$szb = SZBTool::getInstance();