<?php
require_once('core/class/SessionController.php');
$sessionObject = new SessionController();
$sessionObject->sessionDestroy();
header('Location:login.php');
?>