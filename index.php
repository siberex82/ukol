<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 2:54
 */

if(!session_start()){
    session_start();
}
ob_start();

use \bin\main\container;
use \helpers\assets;
use \helpers\dashboardSession;
use \helpers\redirect;
use \helpers\userSession;
use \helpers\message;


try {

    require_once __DIR__ . "/bootstrap.php";

    require_once __DIR__."/config/sql.php";
    require_once __DIR__."/config/config.php";
    require_once __DIR__."/config/assets.php";


    spl_autoload_register(function($class) {
       $ns = explode("\\",$class);
       if($ns[0]=="helpers") {
           $ns = array_reverse($ns);
           require_once _HELPERS . $ns[0] . ".php";
       }
    });

    require_once __DIR__ . "/config/routes.php";

    require_once __DIR__ . "/bin/router.php";


    $container = new container();

    if($sections[0] == "@") {

        if(dashboardSession::match()) {
            $html =  $container->twig()->render("mains/dashboard.twig",
                ["page" => $page, "assets" => assets::header()]);
        }else{
            $html =  $container->twig()->render("mains/dashboard_login.twig",["assets"=>assets::header()]);
        }

    }else {
        if(isset($_COOKIE['useri']) && $_COOKIE['useri']==true){

            if($_COOKIE['userrole']==0){
                $html =  $container->twig()->render("mains/cabinet.twig", ["page" => $page, "assets" => assets::header()]);
            }else if($_COOKIE['userrole']==1) {
                $html =  $container->twig()->render("mains/dashboard.twig", ["page" => $page, "assets" => assets::header()]);
            }

        }else{
            $html =  $container->twig()->render("mains/login.twig", ["page" => $page, "assets" => assets::header()]);
        }

    }


    echo message::show();


}catch(Exception $e) {

    echo $e->getMessage();

}

