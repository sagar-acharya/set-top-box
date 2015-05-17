<?php
require_once('databaseConfig.php');
class SessionController{

    public function __construct(){
        if( !isset($_SESSION) ){
            $this->initSession();
        }
        //session_start();
        //$this->sessionID = session_id();
    }

    public function initSession(){
        session_start();
    }

    public function addSessionData($userData = false){
        if( !isset($_SESSION['userdata'])  ){
            if( $userData == true ){
                $_SESSION['userdata'] = $userData;
            }
            else{
                $_SESSION['userdata'] = '';
            }
        }
    }

    public function isSessionExists(){
        if( isset($_SESSION['userdata']) && !empty($_SESSION['userdata']) ){
            return true;
        }
        else{
            return false;
        }
    }

    public function getSessionData(){
        if( !isset($_SESSION['userdata'])  ){
            return false;
        }else{
            return $_SESSION['userdata'];
        }
    }

    public function sessionDestroy(){
        if($this->isSessionExists()){
            unset( $_SESSION['userdata'] );
        }
        else{
            unset($_SESSION);
            //session_unset();
            //session_destroy();
        }
    }

    public function addCustomerInSession($userData = false){
        unset($_SESSION['customer_data']);
        $_SESSION['customer_data'] = $userData;
    }

    public function getCustomerData(){
        if(isset($_SESSION['customer_data'])  ){
                return $_SESSION['customer_data'];
        }
        else{
            $_SESSION['customer_data'] = '';
            return $_SESSION['customer_data'];
        }
    }
}