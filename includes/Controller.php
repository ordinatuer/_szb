<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Controller extends szb\SZBController
{
    /**
     * active vendors
     * @var array [..., string,...] 
     */
    private $vendors = [];
    /**
     * 
     * @var type 
     */
    private $maps = [];
    
    private $js_anchor = '';
    private $js_in = '';
    
    protected function init()
    {
        $this->views = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/views/';
        $this->asset_path = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/includes/assets/';
        add_shortcode('zb-plugin', [$this, 'zb_pl']);
        
        add_action('loop_end', function() {
            Asset::in_js_list($this->js_anchor, $this->js_in);
        });
    }
    /**
     * Основная фунция обработки шорткода
     * @param array $attrs
     * параметры шорткода
     */
    public function zb_pl($attrs = [])
    {
        $m = new szb\MapModel($attrs);
        
        if ( false === $m->status ) {
            return $this->render('error');
        }
           
        $v = $m->vendor;
        
        // map ID - html attribute
        $id = $v . strval(count($this->maps) + 1);
        // класс-пакет ресурсов * 
        // @TODO проверка существования, обработка ошибок
        $cl = $v . 'Asset';
        require_once($this->asset_path . $cl . '.php');
        
        $asset = new $cl(WP_PLUGIN_URL . '/'. SZBTool::NAME);
        
        if( !in_array($v, $this->vendors) ) {
            $this->vendors[] = $v;
            // публикация ресурсов
            $asset->register();
        }

        if( '' === $this->js_anchor ) {
            $this->js_anchor = $asset->getAnchor();
        }
        if('' === $this->js_in) {
            $this->js_in = 'var ZB = {};' . "\n";
        } 
        $data = $m->getAttrs();
        
        $this->js_in .= 'ZB["' . $id . '"] = ' . json_encode($data) . ';' . "\n";
        
        
        // файл отображения
        $view = $asset->view();
        // импорт переменных в клиентский код
        // посредством inline-js скрипта
        //$asset->in_js($m, 'SZB', ['lon','lat','zoom']);
        
        
        $this->maps[$id] = $m->getAttrs();
        
        return $this->render($view, ['id' => $id]);
    }
    
    
    
}