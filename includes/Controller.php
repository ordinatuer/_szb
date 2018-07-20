<?php
namespace szb;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Controller extends SZBController
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
    
    /**
     * wp-handler скрипта, за которым закрепляется 
     * вкрапление инлайнового js
     * @var string
     */
    private $js_anchor = '';
    
    /**
     * Строка js с определением геоданных
     * inline-js, see $js_anchor
     * @var string
     */
    private $js_in = '';
    
    private $css_in = '';
        
    protected function init()
    {
        $this->views = SZB_DIR .'/views/';
        $this->asset_path = SZB_DIR .'/includes/assets/';
        add_shortcode('zb-plugin', [$this, 'zb_pl']);
        
        add_action('loop_end', function() {
            Asset::in_js_list($this->js_anchor, $this->js_in . $this->css_in);
        });
    }
    /**
     * Основная фунция обработки шорткода
     * @param array $attrs
     * параметры шорткода
     */
    public function zb_pl($attrs = [])
    {
        $m = new MapModel($attrs);
        
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
        
        $cl = '\szb\\' . $cl;
        
        $asset = new $cl();
        
        if( !in_array($v, $this->vendors) ) {
            $this->vendors[] = $v;
            // публикация ресурсов
            
            $res = $asset->register();
            
            if ( false === strpos($this->css_in, $res) ) {
                $this->css_in .= $res;
            }
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
        
        $this->maps[$id] = $m->getAttrs();
        
        return $this->render($view, ['id' => $id]);
    }
    
    
    
}