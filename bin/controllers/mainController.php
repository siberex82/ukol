<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 3:14
 */

namespace bin\controllers;

use \bin\main\container;
use \helpers\redirect;
use helpers\userSession;
use \RedBeanPHP\R as R;
use \helpers\formValidator;

class mainController extends container
{



    public function index()
    {

        if(isset($_POST['ent_email']) && isset($_POST['ent_pass'])){

            $login = trim($_POST['ent_email']);
            $pass = trim($_POST['ent_pass']);

            $userArr = R::getRow("SELECT * FROM users WHERE email=?",[$login]);

            if(!empty($userArr)){
                if(password_verify($pass,$userArr['pass'])){
                    setcookie("userid",$userArr['id'],time()+3600,"/");
                    setcookie("useremail",$userArr['email'],time()+3600,"/");
                    setcookie("userlast",$userArr['last'],time()+3600,"/");
                    setcookie("userrole",$userArr['role'],time()+3600,"/");
                    setcookie("useri",true,time()+3600,"/");
                    userSession::setIp();
                    redirect::reload();
                }else{
                    echo "<script>alert('login or password is wrong!!')</script>";
                }
            }else{
                echo "<script>alert('login or password is wrong!!')</script>";
            }

        }

        if(userSession::match() && $_COOKIE['userrole']==0) {
            $smsArray = R::getAll("SELECT 
i.*,p.firstname,p.lastname,p.thirdname,p.sex,ph.phone FROM injections i 
LEFT JOIN patients p ON p.id=i.patid
LEFT JOIN patientphones ph ON p.id=ph.patid
WHERE i.manager=?",[$_COOKIE['userid']]);

            $smsList="";

            foreach($smsArray as $item){
                $smsList .= "
                    <tr>
                        <th scope=\"row\">$item[id]</th>
                        <td>$item[thirdname] $item[firstname]</td>
                        <td>$item[phone]</td>
                        <td>$item[datepay]</td>
                        <td>$item[dateinject]</td>
                        <td>$item[smsnotification]</td>
                        <td>
                            <a href='/'><i class=\"fas fa-edit\"></i></a>
                            <a href='/'><i class=\"fas fa-trash-alt\"></i></a>
                        </td>
                    </tr>
                ";
            }

            return $this->twig()->render("front/list.twig",["smslist"=>$smsList]);
        }

        if(userSession::match() && $_COOKIE['userrole']==1) {
            return $this->twig()->render("front/admin_list.twig");
        }

    }




    public function addmanager()
    {
        if(userSession::match() && $_COOKIE['userrole']==1) {

        }
    }




    public function addinjection()
    {

        if (userSession::match()) {

            $patArr = R::getAll("SELECT p.*,f.phone FROM patients p 
             LEFT JOIN patientphones f ON p.id=f.patid");

            $patientlist = "";

            foreach ($patArr as $item) {
                $patientlist .= "<option value='$item[id]'> $item[thirdname] - $item[phone] </option>";
            }

            if (isset($_POST['addinj'])) {
                $unix = strtotime($_POST['dateinj']." 00:00:00");

                if(formValidator::string($_POST['prep'])
                        && formValidator::id($_POST['patid'])
                        && formValidator::string($_POST['daypay'])) {


                    $inj = R::dispense("injections");
                    $inj->patid = $_POST['patid'];
                    $inj->datepay = $_POST['daypay'];
                    $inj->nameinj = $_POST['prep'];
                    $inj->unixtimeinj = $unix;
                    $inj->notificationon = 1;
                    $inj->smsnotification = $_POST['smsnotify'];
                    $inj->dateinject = $_POST['dateinj'];
                    $inj->manager = $_COOKIE['userid'];

                    if (R::store($inj) > 0) {
                        echo "<script>alert('успешно записано!'); window.location.href=window.location.href;</script>";
                    }

                }
            }


            return $this->twig()->render("front/addinjection.twig",
                ["patientlist" => $patientlist]);

        }else {
            redirect::home();
        }
    }




    public function addclient()
    {
        if(userSession::match() && $_COOKIE['userrole']==0) {
            if($_POST['addpat']){
                $p = R::dispense('patients');
                $p->thirdname=$_POST['thirdname'];
                $p->firstname=$_POST['firstname'];
                $p->lastname=$_POST['lastname'];
                $p->manager = $_COOKIE['userid'];
                $p->sex=$_POST['sex'];
                $p_id = R::store($p);

                if($p_id>0) {
                    $f = R::dispense('patientphones');
                    $f->phone=$_POST['phone'];
                    $f->patid=$p_id;
                    if(R::store($f)>0) {
                        echo "<script>alert('успешно записано!'); window.location.href=window.location.href;</script>";
                    }
                }
            }
            return $this->twig()->render("front/addclient.twig");
        }else{
            redirect::home();
        }


        if(userSession::match() && $_COOKIE['userrole']==1) {
            return $this->twig()->render("front/admin_addclient.twig");
        }else{
            redirect::home();
        }
    }





    public function sms()
    {


        if(userSession::match() && $_COOKIE['userrole']==0) {
            $smsArray = R::getAll("SELECT 
i.*,p.firstname,p.lastname,p.thirdname,p.sex,ph.phone FROM injections i 
LEFT JOIN patients p ON p.id=i.patid
LEFT JOIN patientphones ph ON p.id=ph.patid
WHERE i.manager=?",[$_COOKIE['userid']]);

            $smsList="";

            foreach($smsArray as $item){
                $smsList .= "
                    <tr>
                        <th scope=\"row\">$item[id]</th>
                        <td>$item[thirdname] $item[firstname]</td>
                        <td>$item[phone]</td>
                        <td>$item[datepay]</td>
                        <td>$item[dateinject]</td>
                        <td>$item[smsnotification]</td>
                        <td>
                            <a href='/'><i class=\"fas fa-edit\"></i></a>
                            <a href='/'><i class=\"fas fa-trash-alt\"></i></a>
                        </td>
                    </tr>
                ";
            }

            return $this->twig()->render("front/sms.twig",["smslist"=>$smsList]);
        }
        if(userSession::match() && $_COOKIE['userrole']==1) {
            return $this->twig()->render("front/admin_sms.twig");
        }
    }





    public function setting()
    {
        if(userSession::match() && $_COOKIE['userrole']==0) {
            return $this->twig()->render("front/setting.twig");
        }
        if(userSession::match() && $_COOKIE['userrole']==1) {
            return $this->twig()->render("front/admin_setting.twig");
        }
    }





    public function logout()
    {
        setcookie("userid",false,time()-3600,"/");
        setcookie("useremail",false,time()-3600,"/");
        setcookie("userlast",false,time()-3600,"/");
        setcookie("useri",true,time()-3600,"/");
        setcookie("userrole",false,time()+3600,"/");
        redirect::home();
    }


}