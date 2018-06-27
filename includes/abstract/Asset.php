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
    
    protected $link_tpl = '\'<link rel="stylesheet" id="%ID%-css" href="%FILE%">\';';
    
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
        if ( [] != $this->js ) {
            foreach( $this->js as $handle => $file ) {
                $this->register_script($handle, $file);
            }
        }
        
        $str = '';
        if ( [] != $this->css ) {
            foreach ( $this->css as $handle => $file ) {
                $file = $this->path . $this->cssf . $file . '.css';
                $str .= str_replace(['%ID%', '%FILE%'], [$handle, $file], $this->link_tpl );
                $str .= "\n";
            }
        }
        
        $str = 'document.getElementsByTagName("head")[0].innerHTML += ' . $str;
        return $str;
    }
    /**
     * @deprecated for M>1
     * work for M=1
     * @param MapModel $model
     * @param type $name
     * @param string $keys
     * @return boolean
     */
    /*
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
    /**
     * @deprecated for M>1
     * @param type $js
     */
    /*
    protected static function register_inline_js($js)
    {
        /**
         * map-api HARDCODE , remove this
         */ /*
        wp_add_inline_script('map-api', $js, 'after');
    }
    */
    public static function in_js_list($handle, $js, $position = 'before')
    {
        wp_add_inline_script($handle, $js, $position);
    }
    
   
    public function getAnchor()
    {
        $js_scripts = array_keys($this->js);
        return $js_scripts[0];
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
        
        wp_register_script(
            $handle,
            $_file,
            [],
            null,
            false
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
}