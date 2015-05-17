<?php
require_once('checkSession.php');
require_once('core/config.php');
require_once('core/class/CustomerController.php');
require_once('core/class/SessionController.php');
$sessionObject = new SessionController();
//$sessionResult = $sessionObject->isSessionExists();

if(isset($_GET['customer_id']) && !empty($_GET['customer_id'])){
    $customerObject = new CustomerController();
    $result = $customerObject->findBoxNoByCustomerId($_GET['customer_id']);
    if($result==null){ ?>
    <div class="alert alert-success" id="login-error">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        No Records Found
    </div>
    <?php
    }
}
if(isset($_POST['submit'])){
    if(!isset($_POST['stb_id'])){
        $_POST['stb_id'] = null;
    }
    $bill_result = $customerObject->generateBill($_POST['customer_id'],$_POST['stb_id'],$_POST['from_month'],$_POST['from_year'],$_POST['to_month'],$_POST['to_year']);
    if($bill_result['status']){ ?>
        <div class="alert alert-success" id="login-error">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong><?php echo $bill_result['message']; ?></strong>
        </div>
    <?php
        //var_dump($bill_result['customer']);exit;
        $sessionObject->addCustomerInSession($bill_result['customer']);
        header("Location:show_bill.php");
    }else{ ?>
        <div class="alert alert-danger" id="login-error">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong><?php echo $bill_result['message']; ?></strong>
        </div>
    <?php }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Customer</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Welcome Admin</a>
        </div>
        <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="login.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                </li>
                <?php require_once('menu_common.php'); ?>
            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="container">
                    <h2>Generate Bill</h2>
                    <?php if($result!=null){ ?>
                    <form role="form" action="#" method="POST">
                        <input type="hidden" name="customer_id" value="<?php echo $_GET['customer_id'];?>"
                        <label> Select Set Top Box Id </label>
                        <?php
                            foreach($result as $boxId){
                        ?>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input name="stb_id[]" type="checkbox" value="<?php echo $boxId['stb_id']; ?>"><?php echo $boxId['stb_id']; ?>
                                </label>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="form-group">
                            <label>From Month</label>
                            <select class="form-control" name="from_month">
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Aug</option>
                                <option value="9">Sept</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>From Year</label>
                            <select class="form-control" name="from_year">
                                <?php
                                for($i=2014;$i<2030;$i++){ ?>
                                    <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>To Month</label>
                            <select class="form-control" name="to_month">
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Aug</option>
                                <option value="9">Sept</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>To Year</label>
                            <select class="form-control" name="to_year">
                                <?php
                                for($i=2014;$i<2030;$i++){ ?>
                                    <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Generate</button>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>

<!-- Custom JS -->
<script>
    $(document).ready(function() {

    });
    $('#search-customer').submit(function(e) {
        e.preventDefault();
        var searchValue = $('#search_value').val();
        var searchBy = $('#search_by').val();
        $.ajax({
            type: "GET",
            url: "<?php echo $base_url;?>core/searchUser.php?searchValue="+searchValue+"&searchBy="+searchBy, //Where to make Ajax calls
            dataType:"html", // Data type, HTML, json etc.
            success: function (result) {
                //$('#userLoaderDown').hide();
                //$('#user_list').append(result);
                $('#table-body').html(result);

            },
            error: function (error) {
                //$('#userLoaderDown').hide();
                alert(error);
            }
        });
    });
</script>

</body>
</html>
