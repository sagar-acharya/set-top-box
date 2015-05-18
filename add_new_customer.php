<?php
require_once('checkSession.php');
require_once('core/config.php');
require_once('core/class/CustomerController.php');
if(isset($_POST['submit'])){
    $customerObject = new CustomerController();
    $result = $customerObject->addNewCustomer($_POST['customer_name'],$_POST['customer_address'],$_POST['customer_box_no_1'],$_POST['customer_box_no_2'],$_POST['customer_box_no_3'],$_POST['customer_paf'],$_POST['customer_package'],$_POST['customer_phone']);
    if($result['status']){ ?>
    <div class="alert alert-success" id="login-error">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <?php echo $result['message']; ?>
    </div>
    <?php
    }else{ ?>
        <div class="alert alert-danger" id="login-error">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <?php echo $result['message']; ?>
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
            <a class="navbar-brand" href="index.php">Welcome Admin</a>
        </div>
        <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
                <div class="col-md-12">
                    <h2>Add New Customer</h2>
<!--                    <h5>Welcome Jhon Deo , Love to see you back. </h5>-->
                    <form id="add-new-customer" role="form" action="#" method="POST">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="customer_name" class="form-control" pattern=".{5,}" required title="5 characters minimum" />
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="customer_phone" class="form-control" pattern=".{5,15}" required title="5-15 characters" />
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="customer_address" class="form-control" rows="5" pattern=".{10,255}" required title="10 to 255 characters" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Set Top Box Number 1</label>
                            <input type="text" id="customer_box_no_1" name="customer_box_no_1" class="form-control" pattern=".{3,}" required title="3 characters minimum" />
                            <p id="box-msg-1" style="display:none" class="help-block alert alert-danger">This set top box number already assigned to someone else, please select another</p>
                            <p class="help-block">Only one box number allowed per customer.</p>
                        </div>
                        <div class="form-group">
                            <label>Set Top Box Number 2</label>
                            <input type="text" id="customer_box_no_2" name="customer_box_no_2" class="form-control" pattern=".{3,}" title="3 characters minimum" />
                            <p id="box-msg-2" style="display:none" class="help-block alert alert-danger">This set top box number already assigned to someone else, please select another</p>
                            <p class="help-block">Only one box number allowed per customer.</p>
                        </div>
                        <div class="form-group">
                            <label>Set Top Box Number 3</label>
                            <input type="text" id="customer_box_no_3" name="customer_box_no_3" class="form-control" pattern=".{3,}" title="3 characters minimum" />
                            <p id="box-msg-3" style="display:none" class="help-block alert alert-danger">This set top box number already assigned to someone else, please select another</p>
                            <p class="help-block">Only one box number allowed per customer.</p>
                        </div>
                        <div class="form-group">
                            <label>PAF Number</label>
                            <input type="text" id="customer_paf" name="customer_paf" class="form-control" pattern=".{3,}" required title="3 characters minimum" />
                            <p id="paf-msg" style="display:none" class="help-block alert alert-danger">This PAF number already assigned to 3 Set Top Boxes, please select another</p>
                            <p class="help-block">One PAF no allowed for 3 Set top box only.</p>
                        </div>
                        <div class="form-group">
                            <label>PACK Price</label>
                            <input type="number" min="0" step="1" name="customer_package" class="form-control" pattern=".{1,}" required title="1 characters minimum" />
                            <p class="help-block">Enter Package Price.</p>
                        </div>
                        <button type="submit" name="submit" class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-primary">Reset Button</button>
                    </form>
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
    $('#customer_box_no_1').keyup(function() {
        var boxNo = $('#customer_box_no_1').val();
        if(boxNo.length>=3){
            $.ajax({
                type: "GET",
                url: "<?php echo $base_url;?>core/checkBoxNo.php?box_no="+boxNo, //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //$('#userLoaderDown').hide();
                    //$('#user_list').append(result);
                    if(result==false){
                        $('#box-msg-1').show();
                    }else{
                        $('#box-msg-1').hide();
                    }

                },
                error: function (error) {
                    //$('#userLoaderDown').hide();
                    alert(error);
                }
            });
        }
    });
    $('#customer_box_no_2').keyup(function() {
        var boxNo = $('#customer_box_no_2').val();
        if(boxNo.length>=3){
            $.ajax({
                type: "GET",
                url: "<?php echo $base_url;?>core/checkBoxNo.php?box_no="+boxNo, //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //$('#userLoaderDown').hide();
                    //$('#user_list').append(result);
                    if(result==false){
                        $('#box-msg-2').show();
                    }else{
                        $('#box-msg-2').hide();
                    }

                },
                error: function (error) {
                    //$('#userLoaderDown').hide();
                    alert(error);
                }
            });
        }
    });
    $('#customer_box_no_3').keyup(function() {
        var boxNo = $('#customer_box_no_3').val();
        if(boxNo.length>=3){
            $.ajax({
                type: "GET",
                url: "<?php echo $base_url;?>core/checkBoxNo.php?box_no="+boxNo, //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //$('#userLoaderDown').hide();
                    //$('#user_list').append(result);
                    if(result==false){
                        $('#box-msg-3').show();
                    }else{
                        $('#box-msg-3').hide();
                    }

                },
                error: function (error) {
                    //$('#userLoaderDown').hide();
                    alert(error);
                }
            });
        }
    });
    $('#customer_paf').keyup(function() {
        var pafNo = $('#customer_paf').val();
        if(pafNo.length>=3){
            $.ajax({
                type: "GET",
                url: "<?php echo $base_url;?>core/checkPafNo.php?paf_no="+pafNo, //Where to make Ajax calls
                dataType:"html", // Data type, HTML, json etc.
                success: function (result) {
                    //$('#userLoaderDown').hide();
                    //$('#user_list').append(result);
                    if(result==false){
                        $('#paf-msg').show();
                    }else{
                        $('#paf-msg').hide();
                    }

                },
                error: function (error) {
                    //$('#userLoaderDown').hide();
                    alert(error);
                }
            });
        }
    });
</script>

</body>
</html>
