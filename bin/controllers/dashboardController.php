<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 3:43
 */
namespace bin\controllers;

use \bin\main\container;
use helpers\dashboardSession;
use \helpers\formValidator;
use \RedBeanPHP\R;

class dashboardController extends container{

    public function index()
    {

        return $this->twig()->render("dashboard/statistics.twig");
    }


    public function dbAuthorisation()
    {

        if(formValidator::email($_POST['db_email']) && formValidator::password($_POST['db_pass'])){
            $user = R::findOne("administrations","email=?",[$_POST["db_email"]]);

            if(!empty($user)) {
                if(password_verify($_POST['db_pass'],$user->pass)){

                    setcookie("shoot", "enter", time()+3600,"/");
                    setcookie("email", $user->pass, time()+3600,"/");
                    setcookie("ban", $user->pass, time()+3600,"/");
                    setcookie("role", $user->pass, time()+3600,"/");
                    setcookie("id", $user->pass, time()+3600,"/");
                    setcookie("last_in", $user->pass, time()+3600,"/");
                    \helpers\dashboardSession::setVerify();

                    \helpers\redirect::dashboard();
                }else{
                    d('fail');
                }
            }else{
                d('fail');
            }
        }else{
            echo "Заполнено не корректно";
        }
    }

}