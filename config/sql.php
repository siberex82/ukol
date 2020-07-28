<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 2:58
 */

use \RedBeanPHP\R as R;

class sql {
    public static function connect()
    {
        R::setup($_ENV["driver"].":host=$_ENV[host];dbname=$_ENV[dbname]",$_ENV["user"],$_ENV["password"]);
    }
}