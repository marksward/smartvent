<?php
require_once("utils.php");
class Temperatures {
    
    private $u0toF;
    protected function get_u0toF() {
        return $this->u0toF;
    }
    protected function set_u0toF($val) {
        $this->u0toF = $val;
    }
    
    private $u22to29;
    protected function get_u22to29() {
        return $this->u22to29;
    }
    protected function set_u22to29($val) {
        $this->u22to29 = $val;
    }
    
    private $outside;
    public function get_Outside() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),1),16, 10);
    }
    
    private $roof;
    public function get_Roof() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),4),16, 10);
    }
    
    private $desiredLounge;
    public function get_DesiredLounge() {
        return base_convert(Utils::get_ascHexGetB($this->get_u22to29(),4),16, 10);
    }
    
    private $desiredBedroom;
    public function get_DesiredBedroom() {
        return base_convert(Utils::get_ascHexGetB($this->get_u22to29(),6),16, 10);
    }
    
    private $lounge;
    public function get_Lounge() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),7),16, 10);
    }
    
    private $bedroom;
    public function get_Bedroom() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),10),16, 10);
    }
    
    function __construct() {
            $url = Utils::get_baseurl() . "tempa.xml";
            $xml = simplexml_load_file($url);
            
            $this->set_u0toF($xml->u0toF);
            $this->set_u22to29($xml->u22to29);
            
    }       
}
?>