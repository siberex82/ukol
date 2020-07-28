<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 15.05.2020
 * Time: 3:52
 */
namespace helpers;

class assets {
    public static function header()
    {
        global $assets;

        $head = "";

        foreach($assets as $asset){
            if(array_key_exists("css",$asset)) {
                $head .= "<link rel='stylesheet' href='/assets/css/$asset[css]'> \r\n";
            }else if(array_key_exists("js",$asset)) {
                $head .= "<script src='/assets/js/$asset[js]'></script> \r\n";
            }
        }

        return $head;
        
    }
}