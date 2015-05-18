<?php
require_once('core/class/SessionController.php');
$sessionObject = new SessionController();
$sessionResult = $sessionObject->isSessionExists();
if($sessionResult==false){
    header('Location:login.php');
}
?>
