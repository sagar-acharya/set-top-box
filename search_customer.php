<?php
require_once('checkSession.php');
require_once('core/config.php');
require_once('core/class/CustomerController.php');
if(isset($_POST['submit'])){
    $customerObject = new CustomerController();
    $result = $customerObject->addNewCustomer($_POST['customer_name'],$_POST['customer_address'],$_POST['customer_box_no'],$_POST['customer_paf'],$_POST['customer_package'],$_POST['customer_phone']);
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
                <div class="col-md-12">
                    <h2>Search Customer</h2>
<!--                    <h5>Welcome Jhon Deo , Love to see you back. </h5>-->
                    <form id="search-customer" role="form" action="#" method="POST">
                        <div class="form-group">
                            <label>Type Text</label>
                            <input type="text" id="search_value" name="search_value" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Search By</label>
                            <select class="form-control" id="search_by">
                                <option value="1">Name</option>
                                <option value="2">Mobile No</option>
                                <option value="3">Set Top Box No</option>
                                <option value="4">PAF No</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-primary">Reset Button</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <h2>Search Result</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>STB No</th>
                            <th>PAF No</th>
                            <th>Current Pack</th>
                            <th>Update Info</th>
                            <th>Add Billing</th>
                            <th>Generate Bill</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">

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
