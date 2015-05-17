<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('databaseConfig.php');

class CustomerController{
    protected $host = DB_HOST;
    protected $dbname = DB_NAME;
    protected $user = DB_USER;
    protected $pass = DB_PASSWORD;
    protected $DBH;

    function __construct() {

        try {
            $this->DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __destruct() {
        $this->DBH = null;
    }

    public function addNewCustomer($name,$address,$boxNo1,$boxNo2,$boxNo3,$pafNo,$package,$phone){
        try
        {
            /* Check If Box 1,2,3 Are Equal Or Not */
            if(!empty($boxNo2) &&$boxNo1 == $boxNo2){
                $response['status'] = false;
                $response['message'] = "<p>Set Top Box number 1 & 2 Should Not be same!! It should be unique</p>";
                return $response;
            }elseif(!empty($boxNo3) && $boxNo2 == $boxNo3){
                $response['status'] = false;
                $response['message'] = "<p>Set Top Box number 2 & 3 Should Not be same!! It should be unique</p>";
                return $response;
            }elseif(!empty($boxNo3) && $boxNo1 == $boxNo3){
                $response['status'] = false;
                $response['message'] = "<p>Set Top Box number 1 & 3 Should Not be same!! It should be unique</p>";
                return $response;
            }
            if(!empty($boxNo2)){
                $boxNoStatus2 = $this->checkBoxNo($boxNo2);
                if($boxNoStatus2==1){
                    $response['status'] = false;
                    $response['message'] = "<p>This set top box number 2 already assigned to someone else, please select another</p>";
                    return $response;
                }
            }
            if(!empty($boxNo3)){
                $boxNoStatus3 = $this->checkBoxNo($boxNo3);
                if($boxNoStatus3==1){
                    $response['status'] = false;
                    $response['message'] = "<p>This set top box number 3 already assigned to someone else, please select another</p>";
                    return $response;
                }
            }
            $boxNoStatus1 = $this->checkBoxNo($boxNo1);
            $pafNoStatus = $this->checkPafNo($pafNo);
            if($boxNoStatus1==1 && $pafNoStatus==3){
                $response['status'] = false;
                $response['message'] = "<p>This set top box number 1 already assigned to someone else, please select another</p><p>This PAF number already assigned to 3 Set Top Boxes, please select another</p>";
            }elseif($boxNoStatus1==1){
                $response['status'] = false;
                $response['message'] = "<p>This set top box number 1 already assigned to someone else, please select another</p>";
            }elseif($pafNoStatus==3){
                $response['status'] = false;
                $response['message'] = "<p>This PAF number already assigned to 3 Set Top Boxes, please select another</p>";
            }else{
                $stmt = $this->DBH->prepare("INSERT INTO customer(name,address,phone) VALUES(:name, :address, :phone)");
                $stmt->bindparam(":name",$name);
                $stmt->bindparam(":address",$address);
                $stmt->bindparam(":phone",$phone);
                $stmt->execute();
                $last_id = $this->DBH->lastInsertId();
                $stmt = $this->DBH->prepare("INSERT INTO customer_stb(customer_id,stb_no,paf_no,pack) VALUES(:customer_id, :stb_no, :paf_no, :pack)");
                $stmt->bindparam(":customer_id",$last_id);
                $stmt->bindparam(":stb_no",$boxNo1);
                $stmt->bindparam(":paf_no",$pafNo);
                $stmt->bindparam(":pack",$package);
                $stmt->execute();
                if(!empty($boxNo2)){
                    $stmt = $this->DBH->prepare("INSERT INTO customer_stb(customer_id,stb_no,paf_no,pack) VALUES(:customer_id, :stb_no, :paf_no, :pack)");
                    $stmt->bindparam(":customer_id",$last_id);
                    $stmt->bindparam(":stb_no",$boxNo2);
                    $stmt->bindparam(":paf_no",$pafNo);
                    $stmt->bindparam(":pack",$package);
                    $stmt->execute();
                }
                if(!empty($boxNo3)){
                    $stmt = $this->DBH->prepare("INSERT INTO customer_stb(customer_id,stb_no,paf_no,pack) VALUES(:customer_id, :stb_no, :paf_no, :pack)");
                    $stmt->bindparam(":customer_id",$last_id);
                    $stmt->bindparam(":stb_no",$boxNo3);
                    $stmt->bindparam(":paf_no",$pafNo);
                    $stmt->bindparam(":pack",$package);
                    $stmt->execute();
                }
                $response['status'] = true;
                $response['message'] = "<p>New User Added Successfully</p>";
            }
            return $response;
        }
        catch(PDOException $e)
        {
            $response['status'] = false;
            $response['message'] = $e->getMessage();
            return $response;
        }
    }

    public function checkBoxNo($boxNo){
        $stmt = $this->DBH->prepare("SELECT * FROM customer_stb WHERE stb_no LIKE :stb_no");
        $stmt->execute(array(":stb_no"=>$boxNo));
        return $stmt->rowCount();
    }

    public function checkPafNo($pafNo){
        $stmt = $this->DBH->prepare("SELECT * FROM customer_stb WHERE paf_no LIKE :paf_no");
        $stmt->execute(array(":paf_no"=>$pafNo));
        return $stmt->rowCount();
    }
    public function findUserByOption($searchValue,$searchBy){
        $userData = null;
        $i = 0;
        switch($searchBy){
            case 1: //By Name
                $searchValue = '%'.$searchValue.'%';
                $stmt = $this->DBH->prepare("SELECT * FROM customer WHERE name LIKE :name");
                $stmt->execute(array(":name"=>$searchValue));
                if($stmt->rowCount()!=0){
                    while ($row = $stmt->fetchObject()) {
                        $userData[$i]['user_id'] = $row->id;
                        $userData[$i]['name'] = $row->name;
                        $userData[$i]['address'] = $row->address;
                        $userData[$i]['phone'] = $row->phone;
                        $userData[$i]['extra_details'] = $this->findExtraDetails($row->id);
                        $i++;
                    }
                }
                break;
            case 2://By Mobile
                $stmt = $this->DBH->prepare("SELECT * FROM customer WHERE phone LIKE :phone");
                $stmt->execute(array(":phone"=>$searchValue));
                if($stmt->rowCount()!=0){
                    while ($row = $stmt->fetchObject()) {
                        $userData[$i]['user_id'] = $row->id;
                        $userData[$i]['name'] = $row->name;
                        $userData[$i]['address'] = $row->address;
                        $userData[$i]['phone'] = $row->phone;
                        $userData[$i]['extra_details'] = $this->findExtraDetails($row->id);
                        $i++;
                    }
                }
                break;
            case 3://By Set Top Box
                $stmt = $this->DBH->prepare("SELECT * FROM customer_stb WHERE stb_no LIKE :stb_no");
                $stmt->execute(array(":stb_no"=>$searchValue));
                if($stmt->rowCount()!=0){
                    while ($row = $stmt->fetchObject()) {
                        $userData = $this->findCustomerById($row->customer_id);
                    }
                }
                break;
            case 4://By PAF
                $stmt = $this->DBH->prepare("SELECT * FROM customer_stb WHERE paf_no LIKE :paf_no");
                $stmt->execute(array(":paf_no"=>$searchValue));
                if($stmt->rowCount()!=0){
                    while ($row = $stmt->fetchObject()) {
                        $userData = $this->findCustomerById($row->customer_id);
                    }
                }
                break;
        }
        return $userData;
    }

    public function findExtraDetails($customerId){
        $extraDetails= null;
        $stmt_extra = $this->DBH->prepare("SELECT * FROM customer_stb WHERE customer_id = :customer_id");
        $stmt_extra->execute(array(":customer_id"=>$customerId));
        $j=0;
        while ($row_extra = $stmt_extra->fetch(PDO::FETCH_ASSOC)) {
            $extraDetails[$j]['stb_table_id'] = $row_extra['id'];
            $extraDetails[$j]['stb_no'] = $row_extra['stb_no'];
            $extraDetails[$j]['paf_no'] = $row_extra['paf_no'];
            $extraDetails[$j]['current_pack'] = $row_extra['pack'];
            $j++;
        }
        return $extraDetails;
    }

    public function findCustomerById($customerId){
        $userData= null;
        $i = 0;
        $stmt = $this->DBH->prepare("SELECT * FROM customer WHERE id = :id");
        $stmt->execute(array(":id"=>$customerId));
        while ($row = $stmt->fetchObject()) {
            $userData[$i]['user_id'] = $row->id;
            $userData[$i]['name'] = $row->name;
            $userData[$i]['address'] = $row->address;
            $userData[$i]['phone'] = $row->phone;
            $userData[$i]['extra_details'] = $this->findExtraDetails($row->id);
            $i++;
        }
        return $userData;
    }

    public function findCustomerByIdForBilling($customerId){
        $extra = $this->findExtraDetails($customerId);
        $count = count($extra);
        $userData= null;
        if($count!=0){
            $stmt = $this->DBH->prepare("SELECT * FROM customer WHERE id = :id");
            $stmt->execute(array(":id"=>$customerId));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            for($i=0;$i<$count;$i++){
                $userData[$i]['user_id'] = $row['id'];
                $userData[$i]['name'] = $row['name'];
                $userData[$i]['address'] = $row['address'];
                $userData[$i]['phone'] = $row['phone'];
                $userData[$i]['stb_table_id'] = $extra[$i]['stb_table_id'];
                $userData[$i]['stb_no'] = $extra[$i]['stb_no'];
                $userData[$i]['paf_no'] = $extra[$i]['paf_no'];
                $userData[$i]['current_pack'] = $extra[$i]['current_pack'];
            }
        }
        return $userData;
    }
    public function addBillData($customerId,$package,$month,$year,$payment,$stbId){
        $billingInfoStatus = $this->findBillingInformation($customerId,$stbId,$month,$year);
        if($billingInfoStatus){
            $result['status'] = false;
            $result['message'] = 'This Billing Information already present';
            return $result;
        }
        try
        {
            $stmt = $this->DBH->prepare("INSERT INTO bill(customer_id,stb_id,pack,month,year,paid) VALUES(:customer_id, :stb_id, :pack, :month, :year, :paid)");
            $stmt->bindparam(":customer_id",$customerId);
            $stmt->bindparam(":stb_id",$stbId);
            $stmt->bindparam(":pack",$package);
            $stmt->bindparam(":month",$month);
            $stmt->bindparam(":year",$year);
            $stmt->bindparam(":paid",$payment);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = 'Billing information added successfully';
        }
        catch(PDOException $e)
        {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function findBillingInformation($customerId,$stbId,$month,$year){
        $stmt = $this->DBH->prepare("SELECT * FROM bill WHERE customer_id = :customer_id AND stb_id LIKE :stb_id AND month = :month AND year = :year");
        $stmt->execute(array(":customer_id"=>$customerId,":stb_id"=>$stbId,":month"=>$month,":year"=>$year));
        if($stmt->rowCount()!=0){
            return true;
        }else{
            return false;
        }
    }

    public function findBoxNoByCustomerId($customerId){
        $boxId = null;
        $i = 0;
        $stmt = $this->DBH->prepare("SELECT * FROM customer_stb WHERE customer_id = :customer_id");
        $stmt->execute(array(":customer_id"=>$customerId));
        if($stmt->rowCount()!=0){
            while ($row = $stmt->fetchObject()) {
                $boxId[$i]['stb_id'] = $row->stb_no;
                $i++;
            }
        }
        return $boxId;
    }

    public function generateBill($customerId,$stbId,$fromMonth,$fromYear,$toMonth,$toYear){
        if($stbId==null){
            $result['status'] = false;
            $result['message'] = 'Please select atleast one Box Id';
            return $result;
        }
        if($fromMonth<=$toMonth && $fromYear<=$toYear){
            $count = count($stbId);
            $customerData = null;
            $uniqueData = array();
            $j =0;
            for($i=0;$i<$count;$i++){
                $stmt = $this->DBH->prepare("SELECT * FROM bill WHERE customer_id = :customer_id AND stb_id LIKE :stb_no AND month >= :month1 AND month <= :month2 AND year >= :year1 AND year <= :year2");
                $stmt->execute(array(
                    ":customer_id"=>$customerId,
                    ":stb_no"=>$stbId[$i],
                    ":month1"=>$fromMonth,
                    ":month2"=>$toMonth,
                    ":year1"=>$fromYear,
                    ":year2"=>$toYear
                ));
                if($stmt->rowCount()!=0){
                    while ($row = $stmt->fetchObject()) {
                        $customerData[$j]['stb_id'] = $row->stb_id;
                        $customerData[$j]['pack'] = $row->pack;
                        if($row->month==1){
                            $month = 'JAN';
                        }
                        if($row->month==2){
                            $month = 'FEB';
                        }
                        if($row->month==3){
                            $month = 'MAR';
                        }
                        if($row->month==4){
                            $month = 'APRIL';
                        }
                        if($row->month==5){
                            $month = 'MAY';
                        }
                        if($row->month==6){
                            $month = 'JUN';
                        }
                        if($row->month==7){
                            $month = 'JULY';
                        }
                        if($row->month==8){
                            $month = 'AUG';
                        }
                        if($row->month==9){
                            $month = 'SEPT';
                        }
                        if($row->month==10){
                            $month = 'OCT';
                        }
                        if($row->month==11){
                            $month = 'NOV';
                        }
                        if($row->month==12){
                            $month = 'DEC';
                        }
                        $customerData[$j]['month'] = $month;
                        $uniqueData[] = $customerData[$j]['stb_id'];
                        $j++;
                    }
                }
            }
            if($customerData!=null){
                //var_dump($customerData);exit;
                $uniqueValues = array_unique($uniqueData);
                $pafNo = $this->findPafNoByBoxId($uniqueValues);
                $customerPersonal = $this->getCustomerById($customerId);

                $customerFinalData['personal_info'] = $customerPersonal;
                $customerFinalData['pafNo'] = $pafNo;
                $customerFinalData['billing_info'] = $customerData;
                $result['status'] = true;
                $result['message'] = 'Generating Bill, please wait';
                $result['customer'] = $customerFinalData;
            }
        }else{
            $result['status'] = false;
            $result['message'] = 'from moth & from year should be less than or equal =, to month & to year';
        }
        //echo "<pre>"; print_r($result);exit;
        return $result;
    }
    public function findPafNoByBoxId($boxId){
        $i = 0;
        $pafId = null;
        foreach($boxId as $stbId){
            $stmt = $this->DBH->prepare("SELECT * FROM customer_stb WHERE stb_no LIKE :stb_no");
            $stmt->execute(array(":stb_no"=>$stbId));
            if($stmt->rowCount()!=0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $pafId = $row['paf_no'];
                //$i++;
            }
        }
        //$pafId = array_unique($pafId);
        return $pafId;
    }

    public function getCustomerById($customerId){
        $userData= null;
        $stmt = $this->DBH->prepare("SELECT * FROM customer WHERE id = :id");
        $stmt->execute(array(":id"=>$customerId));
        while ($row = $stmt->fetchObject()) {
            $userData['user_id'] = $row->id;
            $userData['name'] = $row->name;
            $userData['address'] = $row->address;
            $userData['phone'] = $row->phone;
        }
        return $userData;
    }
}
?>