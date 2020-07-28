<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 2:59
 */
$routes = [];

$routes["default"] = "bin\\controllers\\mainController|index";
$routes["@"] = "bin\\controllers\\dashboardController|index";

$routes["list"] = "bin\\controllers\\mainController|index";
$routes["addclient"] = "bin\\controllers\\mainController|addclient";
$routes["addinjection"] = "bin\\controllers\\mainController|addinjection";
$routes["sms"] = "bin\\controllers\\mainController|sms";
$routes["setting"] = "bin\\controllers\\mainController|setting";

$routes["addmanager"] = "bin\\controllers\\mainController|addmanager";



$routes["logout"] = "bin\\controllers\\mainController|logout";




