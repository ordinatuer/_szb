<?php
namespace szb;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Controller extends SZBController
{
    protected function init()
    {
        $this->views = SZB_DIR .'/views/admin/';
        $this->asset_path = SZB_DIR .'/includes/admin/assets/';
        add_action('admin_menu', [$this, 'admin_menu']);
    }
    
    public function admin_menu()
    {
        add_menu_page('Настройки SZB', 'SZB-Tools', 'edit_pages', 'szbtools', [$this, 'admin_page']);
        //add_submenu_page('szbtools','Настройки ZB 2Gis', '2GIS', 'edit_pages', 'szbdg', [$this, 'admin_dg_page']);
        //add_submenu_page('szbtools', 'Описание шорткода','SZB шорткод','edit_pages', 'szb_sc', [$this, 'szb_sc_page']);
        
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
        
        $asset = new $cl();
        $asset->register();
        $view = $asset->view();
        // inline js может отсутствовать
        
        echo $this->render($view);
    }
    
    public function szb_sc_page()
    {
        
    }
    
    public function admin_dg_page()
    {
        if ( isset($_POST['dg-admin-post']) ) {
            require 'dgModel.php';
            dgModel::pre();
        }
        
        echo $this->render('dg-admin');
    }
}