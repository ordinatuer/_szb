<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Controller extends szb\SZBController
{
    protected function init()
    {
        $this->views = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/views/admin/';
        $this->asset_path = WP_PLUGIN_DIR . '/'. SZBTool::NAME .'/includes/admin/assets/';
        add_action('admin_menu', [$this, 'admin_menu']);
    }
    
    public function admin_page()
    {
        //echo '<h1>SZB admin page</h1>';
        
        
        echo $this->render('yandex-admin');
    }
    
    public function admin_menu()
    {
        add_menu_page('Настройки SZB', 'SZB-Tools', 8, 'szbtools', [$this, 'admin_page']);
//        add_submenu_page('zbtools','Настройки ZB', 'Настройки', 8, 'zbtools', [$this, 'admin_page']);
//        add_submenu_page('zbtools','Точные настройки ZB', 'Больше настроек', 8, 'zbtools-1', [$this, 'admin_sub_page']);
    }
}