<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 4:39
 */
namespace helpers;


class redirect {

    public static function to($uri)
    {
        header("Location:".$uri);
    }

    public static function home()
    {
        header("Location: /");
    }

    public static function dashboard()
    {
        header("Location: /@");
    }


    public static function back()
    {
        echo "<script> window.history.back();</script>";
    }


    public static function reload()
    {
        header("Location:".$_SERVER["REQUEST_URI"]);
    }


    public static function userlogin()
    {
        header("Location: /login/");
    }

}