<?php
require_once('config.php');
require_once('class/CustomerController.php');
//var_dump($_GET['box_no']);exit;
if(isset($_GET['box_no']) && !empty($_GET['box_no'])){
    $customerObject = new CustomerController();
    $result = $customerObject->checkBoxNo($_GET['box_no']);
    if($result==1){
        echo false;
    }else{
        echo true;
    }
}