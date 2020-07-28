<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 15.05.2020
 * Time: 3:36
 */
namespace helpers;



class  formValidator {

    public static function email($string)
    {
        if(!empty($string) && is_string($string)){
           $match =  preg_match("/^[a-zA-Z0-9\.\-\_]{3,30}@{1}\w{1,30}\.{1}\w{1,5}\.{0,1}\w{0,5}$/",$string);
           if($match==1){
               return true;
           }else{
               return false;
           }
        }else{
            return false;
        }
    }


    public static function string($string)
    {
        if(!empty($string) && is_string($string)){
            $match =  preg_match("/^[a-zA-Zа-яА-Я0-9\.\_\-]{2,200}$/u",$string);
            if($match==1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }



    public static function id($id)
    {
        if(!empty($id) && is_numeric($id)){
            $match =  preg_match("/^[0-9]{1,10}$/",$id);
            if($match==1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }


    public static function password($string)
    {
        if(!empty($string) && is_string($string)){
            $match =  preg_match("/^[a-zA-Z0-9\.\-\_\@\!\?\=\#\%\&]{6,30}$/",$string);
            if($match==1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}