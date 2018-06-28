<?php
namespace szb;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Controller extends SZBController
{
    protected function init()
    {
        $this->views = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/views/admin/';
        $this->asset_path = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/includes/admin/assets/';
        add_action('admin_menu', [$this, 'admin_menu']);
    }
    
    public function admin_menu()
    {
        add_menu_page('Настройки SZB', 'SZB-Tools', 'edit_pages', 'szbtools', [$this, 'admin_page']);
//        add_submenu_page('szbtools','Настройки ZB 2Gis', '2GIS', 'edit_pages', 'dg', [$this, 'admin_dg_page']);
//        add_submenu_page('szbtools','Точные настройки ZB', 'Больше настроек', 8, 'zbtools-1', [$this, 'admin_sub_page']);
    }
    
    public function admin_page()
    {
        //$flag = get_option(SZBTool::PREFIX . 'vendor', false);
        $flag = false;
        
        
        // нужен рефакторинг этого 
        // с наведением порядка с внешними методами Asset
        if( !$flag ) {
            $v = 'short';
        }
        
        $cl = $v . 'Asset';
        
        require_once( $this->asset_path . $cl . '.php');
        
        $cl = '\szb\\' . $cl;
        
        $asset = new $cl(WP_PLUGIN_URL . '/'. SZBTool::NAME);
        $asset->register();
        $view = $asset->view();
        // inline js может отсутствовать
        
        echo $this->render($view);
    }
    
//    public function admin_dg_page() {
//        echo $this->render()
//    }
}