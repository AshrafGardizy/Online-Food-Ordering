<?php
require_once("db.php");

// Chk if the user logged_in
if (!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
}

// Select All Customers
$query_sel_cust = "SELECT * FROM customer";
$sel_cust_stmt = $pdo->prepare($query_sel_cust);
$sel_cust_stmt->execute();
$cust_num = $sel_cust_stmt->rowCount();
$cust_rows = $sel_cust_stmt->fetchAll();

// Add New Customer
if (isset($_POST["add_customer_form"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
    $address = $_POST["address"];
    $dob_y = $_POST["dob_y"];
    $password = $_POST["password"];

    $query = "INSERT INTO customer(firstname, lastname, email, phone_no, address, dob_y, password) VALUES(:firstname, :lastname, :email, :phone_no, :address, :dob_y, :password)";
    $stmt = $pdo->prepare($query);
    $execute = $stmt->execute([
        "firstname"=>$firstname,
        "lastname"=>$lastname,
        "email"=>$email,
        "phone_no"=>$phone_no,
        "address"=>$address,
        "dob_y"=>$dob_y,
        "password"=>md5($password)
    ]);
    ?>
    <script>
        alert("New Customer Added Successfully!");
        window.location = "customer.php";
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>Welcome <?= $sel_admin_data_row->lastname; ?> To Admin Panel</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong><i class="icon fa fa-shopping-cart"></i> Yummy</strong></a>
				
		<div id="sideNav" href="">
		<i class="fa fa-bars icon"></i> 
		</div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" data-toggle="modal" data-target="#userProfile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="category.php"><i class="fa fa-sitemap"></i> Category Management</a>
                    </li>
					<li>
                        <a href="food.php"><i class="fa fa-desktop"></i> Food Management</a>
					</li>
                    <li>
                        <a class="active-menu"  href="customer.php"><i class="fa fa-edit"></i> Customer Management </a>
                    </li>
                    <li>
                        <a href="staff.php"><i class="fa fa-users"></i> Staff Management </a>
                    </li>
                    <li>
                        <a href="msg.php"><i class="fa fa-fw fa-file"></i> Messages Management</a>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
		<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Dashboard <small>
                                    Welcome <?= $sel_admin_data_row->firstname . " " . $sel_admin_data_row->lastname; ?>
                                    </small>
                        </h1>
						<ol class="breadcrumb">
                            <li>Dashboard</li>
					  <li class="active">Customers</li>
					</ol> 
									
		</div>
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total Customers
                                <button class="btn btn-success" data-toggle="modal" data-target="#add">
                                    Add New Customer <i class="fa fa-plus"></i>
                                </button>
                            </div> 
                            <div class="panel-body">
                                <?php if ($cust_num == 0) { echo "No Customer Yet!"; } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Address</th>
                                                <th>DOB</th>
                                                <th>Joined At</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $x = 1; foreach ($cust_rows as $cust_row) { ?>
                                                <tr>
                                                    <td><?= $x; ?></td>
                                                    <td><?= $cust_row->firstname; ?></td>
                                                    <td><?= $cust_row->lastname; ?></td>
                                                    <td><?= $cust_row->email; ?></td>
                                                    <td><?= $cust_row->phone_no; ?></td>
                                                    <td><?= $cust_row->address; ?></td>
                                                    <td><?= $cust_row->dob_y; ?></td>
                                                    <td><?= $cust_row->created_at; ?></td>
                                                    <td><a href="delete_customer.php?id=<?= $cust_row->cust_id; ?>" class="btn btn-danger">Delete</a></td>
                                                </tr>
                                            <?php $x++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
			
		
				<footer><p>All right reserved. Developed by: <b>Ashraf Gardizy</b></p>
				
        
				</footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

<!-- Add Category Modal -->
<div class="modal fade" id="add" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer</h4>
        </div>
        <div class="modal-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Enter Lastname" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Enter Email" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="phone_no" placeholder="Enter Phone No" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Enter Address" required="">
              </div>
              <div class="form-group">
                <select class="form-control" name="dob_y">
                    <?php $year = 1990; while ($year <= 2010) { ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php $year++; } ?>
                </select>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password" required="">
              </div>
              <button type="submit" class="btn btn-success" name="add_customer_form">Add</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- //AddCategory Modal -->


    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
	 
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	
	
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	
	 <script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

      
    <!-- Chart Js -->
    <script type="text/javascript" src="assets/js/Chart.min.js"></script>  
    <script type="text/javascript" src="assets/js/chartjs.js"></script> 

</body>

</html>