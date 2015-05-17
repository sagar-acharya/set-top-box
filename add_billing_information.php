<?php
require_once('checkSession.php');
require_once('core/config.php');
require_once('core/class/CustomerController.php');
if(isset($_GET['customer_id']) && !empty($_GET['customer_id'])){
    $customerObject = new CustomerController();
    $result = $customerObject->findCustomerByIdForBilling($_GET['customer_id']);
    if($result==null){ ?>
    <div class="alert alert-success" id="login-error">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        No Records Found
    </div>
    <?php
    }
}
if(isset($_POST['submit'])){
    $bill_result = $customerObject->addBillData($_POST['customer_id'],$_POST['package'],$_POST['month'],$_POST['year'],$_POST['payment'],$_POST['stb_id']);
    if($bill_result['status']){ ?>
        <div class="alert alert-success" id="login-error">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong><?php echo $bill_result['message']; ?></strong>
        </div>
    <?php
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
                <div class="container">
                    <h2>Add Billing Information</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>STB No</th>
                            <th>PAF No</th>
                            <th>Current Pack</th>
                            <th>Select Month</th>
                            <th>Select Year</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        <?php
                            if($result!=null){
                                $j = 0;
                                foreach($result as $customer){?>
                                    <tr>
                                    <td><?php echo $customer['name']; ?></td>
                                    <td><?php echo $customer['phone']; ?></td>
                                    <td><?php echo $customer['stb_no']; ?></td>
                                    <td><?php echo $customer['paf_no']; ?></td>
                                    <td><?php echo $customer['current_pack']; ?></td>
                                    <form role="form" action="#" method="POST">
                                        <input type="hidden" name="customer_id" value="<?php echo $customer['user_id']; ?>" >
                                        <input type="hidden" name="package" value="<?php echo $customer['current_pack']; ?>" >
                                        <input type="hidden" name="stb_id" value="<?php echo $customer['stb_no']; ?>" >
                                        <input type="hidden" name="payment" value="0" >
                                        <td>
                                            <select class="form-control" name="month">
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
                                        </td>
                                        <td>
                                            <select class="form-control" name="year">
                                        <?php
                                        for($i=2014;$i<2030;$i++){ ?>
                                            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                        ?>
                                            </select>
                                        </td>
                                        <!--<td>
                                            <select class="form-control" name="payment">
                                                <option value="1">Yes</option>
                                                <option value="1">No</option>
                                            </select>
                                        </td>-->
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                        </td>
                                    </form>
                                <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
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
