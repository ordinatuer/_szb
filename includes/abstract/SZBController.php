<?php
namespace szb;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class SZBController
{
    /**
     * path to views files
     * @var string
     */
    protected $views = '';
    /**
     * path to asset file
     * @var string
     */
    protected $asset_path;
    
    public function __construct()
    {
        $this->init();
    }
    abstract protected function init();
    
    protected function render($view, $data = [])
    {
        ob_start();
        require($this->views . $view . '.php');
        
        $_s = ob_get_contents();
        ob_end_clean();
        
        return $_s;
    }
}