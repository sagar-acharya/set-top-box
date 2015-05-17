<?php
require_once('config.php');
require_once('class/CustomerController.php');
//var_dump($_GET['box_no']);exit;
if(isset($_GET['searchValue']) && !empty($_GET['searchValue']) && isset($_GET['searchBy']) && !empty($_GET['searchBy'])){
    $customerObject = new CustomerController();
    $userData = $customerObject->findUserByOption($_GET['searchValue'],$_GET['searchBy']);
    $stbNo = '';
    $pafNo = '';
    $package = '';
    if($userData!=null){
        foreach($userData as $user){?>
            <tr>
            <td><?php echo $user['name'];?></td>
            <td><?php echo $user['address'];?></td>
            <td><?php echo $user['phone'];?></td>
            <?php
            foreach($user['extra_details'] as $extra){
                if(empty($stbNo)){
                    $stbNo = $extra['stb_no'];
                }else{
                    $stbNo = $stbNo.','.$extra['stb_no'];
                }
                if(empty($pafNo)){
                    $pafNo = $extra['paf_no'];
                }else{
                    $pafNo = $pafNo.','.$extra['paf_no'];
                }
                if(empty($package)){
                    $package = $extra['current_pack'];
                }else{
                    $package = $package.','.$extra['current_pack'];
                }
            }
            ?>
            <td><?php echo $stbNo;?></td>
            <td><?php echo $pafNo;?></td>
            <td><?php echo $package;?></td>
            <td>Update</td>
            <td><a href="<?php echo $base_url.'add_billing_information.php?customer_id='.$user['user_id'];?>">Click</a></td>
            <td><a href="<?php echo $base_url.'generate_bill.php?customer_id='.$user['user_id'];?>">Click</a></td>
            </tr>
    <?php
        }
    }else{ ?>
        <tr>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
        </tr>
    <?php
    }
}