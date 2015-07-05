<?php
require_once("utils.php");
class Humidity {
    
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
    
    private $u12to1C;
    protected function get_u12to1C() {
        return $this->u12to1C;
    }
    protected function set_u12to1C($val) {
        $this->u12to1C = $val;
    }
    private $outside;
    public function get_Outside() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),2),16, 10);
    }
    
    private $roof;
    public function get_Roof() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),5),16, 10);
    }
    
    private $desiredLounge;
    public function get_DesiredLounge() {
        return base_convert(Utils::get_ascHexGetB($this->get_u22to29(),5),16, 10);
    }
    
    private $desiredBedroom;
    public function get_DesiredBedroom() {
        return base_convert(Utils::get_ascHexGetB($this->get_u22to29(),7),16, 10);
    }
    
    private $lounge;
    public function get_Lounge() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),8),16, 10);
    }
    
    private $bedroom;
    public function get_Bedroom() {
        return base_convert(Utils::get_ascHexGetB($this->get_u0toF(),11),16, 10);
    }
    
    private $relays;
    public function get_Relays() {
        return base_convert(Utils::get_ascHexGetB($this->get_u12to1C(),4),16,10);
    }
    
    private $fan;
    public function get_Fan() {
        if (Utils::bitIsSet($this->get_Relays(),4)) {
            return "low";
        }
        if (Utils::bitIsSet($this->get_Relays(),3)) {
            return "medium";
        }
        
        if (Utils::bitIsSet($this->get_Relays(),2)) {
            return "high";
        }
        
        return "off";
        
    }
    
    private $airsource;
    public function get_AirSource() {
        if (Utils::bitIsSet($this->get_Relays(),1)) {
            return "recycle";
        }
        if (Utils::bitIsSet($this->get_Relays(),0)) {
            return "outside";
        }
        
        return "roof";
    }
    
    function __construct() {
            $url = Utils::get_baseurl() . "relhumid.xml";
            
            Utils::delog("Url:" . $url);
            $xml = simplexml_load_file($url);
            print_r($xml);
            $this->set_u0toF($xml->u0toF);
            $this->set_u22to29($xml->u22to29);
            $this->set_u12to1C($xml->u12to1C);
            
            
    }       
}
?>