<?php
namespace szb;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Asset
{
    protected $jsf = '';
    protected $cssf = '';
    
    protected $css = [];
    protected $js = [];
    
    protected $view = '';
    
    protected $link_tpl = '\'<link rel="stylesheet" id="%ID%-css" href="%FILE%">\';';
    
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
                $file = SZB_URI . $this->cssf . $file . '.css';
                $str .= str_replace(['%ID%', '%FILE%'], [$handle, $file], $this->link_tpl );
                $str .= "\n";
            }
        }
        
        $str = 'document.getElementsByTagName("head")[0].innerHTML += ' . $str;
        return $str;
    }
    
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
            $_file = SZB_URI . $this->jsf . $_file . '.js';
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
            SZB_URI . $this->cssf . $file . '.css',
            [],
            null,
            'all'
        );
        
        wp_enqueue_style($handle);
    }
}