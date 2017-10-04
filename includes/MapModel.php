<?php
namespace szb;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MapModel
{
    public $lat;
    public $lon;
    public $zoom;
    public $vendor;
    
    
    
    public $status = false;
    
    private $_atts_default = [
        'vendor' => 'yandex',
        'zoom' => '9',
        'lon' => '54.99244',
        'lat' => '73.36859',
        'header' => '',
        'content' => '',
    ]; 
    
    private $_vendors = [
        'yandex',
        'dg'
    ];
    
    private $_atts_vars = [
        'y' => 'yandex',
        '2gis' => 'dg',
    ];
    
    private $attrs;
    
    public function __construct($attrs = [])
    {
        $this->attrs = $attrs;
        
        $this->init();
    }
    
    public function getAttrs()
    {
        return $this->attrs;
    }


    protected function init()
    {
        if ( !isset($this->attrs['db']) OR 0 === (int)$this->attrs['db'] ) {
            foreach($this->_atts_default as $attr => $val) {
                if( isset($this->attrs[$attr]) ) {
                    $this->$attr = $this->attrs[$attr];
                } else {
                    // значение из умолчания ? выкинуть исключение ?
                    $this->$attr = $this->_atts_default[$attr];
                }
            }
        } else {
            foreach ( $this->_atts_default as $attr => $val ) {
                $this->$attr = get_option( SZBTool::PREFIX . $attr, $val );
            }
        }
        
        $this->check();
    }
    
    
    
    
    
    /**
     * set validate status
     */
    protected function check()
    {
        $c = ( -180 < $this->lon AND $this->lon < 180 AND -90 < $this->lat AND $this->lat < 90 );
        $z = ( 0 < $this->zoom AND $this->zoom < 19 );
        $v = in_array( $this->vendor, $this->_vendors );
        
        $this->status = ( $c AND $z AND $v);
    }
}