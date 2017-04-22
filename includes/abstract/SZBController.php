<?php
namespace szb;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class SZBController
{
    protected $views = '';
    protected $asset_path;
    
    public function __construct()
    {
        $this->init();
    }
    abstract protected function init();
    
    protected function render($view, $data = [])
    {
        ob_start();
        require_once($this->views . $view . '.php');
        
        $_s = ob_get_contents();
        ob_end_clean();
        
        return $_s;
    }
}