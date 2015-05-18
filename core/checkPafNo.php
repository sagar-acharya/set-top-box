<?php
require_once('config.php');
require_once('class/CustomerController.php');
if(isset($_GET['paf_no']) && !empty($_GET['paf_no'])){
    $customerObject = new CustomerController();
    $result = $customerObject->checkPafNo($_GET['paf_no']);
    if($result==3){
        echo false;
    }else{
        echo true;
    }
}