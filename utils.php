<?php
class Utils {
    public static function delog($log, $screen = "file") {
        $file = fopen("./log.txt", "a+");
        fwrite($file, $log . PHP_EOL);
        if ($screen == "screen") {
            echo($log . PHP_EOL);
        }
        
    }
    
    public static function get_baseurl() {
        
        return "http://192.168.1.170/";
        
    }
    
    public static function get_ascHexGetB($s,$idx) {
        $i = $idx * 2;
        if (strlen($s) < ($i + 2)) {
            return 0;
        }
        
        return substr($s,$idx * 2,2);
    }
    /** Test if bit is set, num=variable, bit=index of bit, value from 0-n */
    public static function bitIsSet($num,$bit) {
        $mask=1<<$bit;
        return $num&$mask;
    }
}
?>