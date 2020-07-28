<?php

namespace helpers;


class userSession {
    public static function setIp() {
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    public static function match()
    {

        if(isset($_COOKIE['useri']) && $_COOKIE['useri']==true){
            if($_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']){
                if($_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else {
            return false;
        }
    }
}