<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use szb\MapModel;

class Asset
{
    protected $jsf = '';
    protected $cssf = '';
    
    protected $css = [];
    protected $js = [];
    
    protected $view = '';
    
    protected $path = '';
//    protected static $instance = null;
//    public static function register()
//    {
//        if ( is_null(static::$instance) ) {
//            static::$instance = new static();
//        }
//        
//        return static::$instance;
//    }
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function view()
    {
        return $this->view;
    }
    
    public function register()
    {
        $this->register_asset();
    }
    
    public function in_js(MapModel $model, $name, $keys = [])
    {
        if ( [] == $keys ) {
            $keys = ['lon', 'lat', 'zoom'];
        }
        
        $js = 'var ' . $name . '= {';
        $js_vars = [];
        
        foreach ( $keys as $key) {
            if ( !isset($model->$key) ) {
                return false;
            }
            
            $js_vars[] = '"' . $key . '" : "' . $model->$key . '"';
        }
        
        $js .= implode(', ', $js_vars);
        $js .= '};';
        
        //return $js;
        
        $this->register_inline_js($js);
    }
    
    protected function register_asset()
    {
        if ( [] != $this->css ) {
            foreach ($this->css as $handle => $file) {
                $this->register_style($handle, $file);
            }
        }
        
        if ( [] != $this->js ) {
            foreach( $this->js as $handle => $file ) {
                $this->register_script($handle, $file);
            }
        }
    }
    
    protected function register_script($handle, $file)
    {
        $_file = $file;
        if ( false === strpos($_file, '://') ) {
            $_file = $this->path . $this->jsf . $_file . '.js';
        }
        
        //exit($_file . ' | ' . $handle);
        
        wp_register_script(
            $handle,
            $_file,
            [],
            null
        );
            
        wp_enqueue_script($handle);
    }
    
    protected function register_style($handle, $file)
    {
        wp_register_style(
            $handle,
            $this->path . $this->cssf . $file . '.css',
            [],
            null,
            'all'
        );
        
        wp_enqueue_style($handle);
    }
    protected function register_inline_js($js)
    {
        wp_add_inline_script('map-api', $js, 'after');
    }
}