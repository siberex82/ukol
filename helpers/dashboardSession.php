<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 15.05.2020
 * Time: 4:09
 */

namespace helpers;


class dashboardSession {

    public static function setVerify() {
        setcookie("useragent",$_SERVER["HTTP_USER_AGENT"], _SESSION_TIME,"/");
        setcookie("userip",$_SERVER["REMOTE_ADDR"], _SESSION_TIME,"/");
    }

    public static function match()
    {
        if(isset($_COOKIE["shoot"]) && $_COOKIE["shoot"] == "enter"){

            if(isset($_COOKIE["useragent"]) && isset($_COOKIE["userip"])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}