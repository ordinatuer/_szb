<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Controller extends szb\SZBController
{
    protected function init()
    {
        $this->views = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/views/';
        $this->asset_path = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/includes/assets/';
        add_shortcode('zb-plugin', [$this, 'zb_pl']);
    }
    /**
     * Основная фунция обработки шорткода
     * @param array $attrs
     * параметры шорткода
     */
    public function zb_pl($attrs = [])
    {
        $m = new szb\MapModel($attrs);
        
        //$m->show();
        
        if ( false === $m->status ) {
            return $this->render('error');
        }
           
        $v = $m->vendor;
        
        // класс-пакет ресурсов * 
        // @TODO проверка существования, обработка ошибок
        $cl = $v . 'Asset';
        require_once($this->asset_path . $cl . '.php');
        
        $asset = new $cl(WP_PLUGIN_URL . '/'. SZBTool::NAME);
        // публикация ресурсов
        $asset->register();
        // файл отображения
        $view = $asset->view();
        // импорт переменных в клиентский код
        // посредством inline-js скрипта
        $asset->in_js($m, 'SZB', ['lon','lat','zoom']);
        
        
        return $this->render($view);
    }
    
    
    
}