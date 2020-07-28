<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 2:56
 */

if(!isset($routes) || !is_array($routes)){
    exit('routes error, routes not found');
}
$page = "systems error, empty page";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri,"/");

if(!empty($uri)){

   $sections =  explode("/",$uri);
   $quant = count($sections);

   if($quant<3){

       if(array_key_exists($uri,$routes)){

         $dataRoute = explode("|",$routes[$uri]);

       }else{
           exit('page not found');
       }

   }else if($quant == 3){

      $key = $sections[0]."/".$sections[1]."/.*";

       if(array_key_exists($key,$routes)){

           $dataRoute = explode("|",$routes[$key]);

           define("_ARGUMENT",$sections[2]);
       }else{
           exit('page not found');
       }

   }


}else{

    if(array_key_exists("default",$routes)){

        $dataRoute = explode("|",$routes["default"]);

    }else{
        exit('Fatal error! Home page not found');
    }

}


$p = str_replace("\\","/",$dataRoute[0]);
$path = $p.".php";
$class = $dataRoute[0];
$method = $dataRoute[1];



if(file_exists($path)){
    require_once $path;

    if(class_exists($class) && method_exists($class, $method)){
        $temp = new $class;
        $page = $temp->$method();
    }
}



