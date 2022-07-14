<?php
require_once("db.php");

// Chk if the user logged_in
if (!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
}

// Select All Orders
$query_sel_orders = "
    SELECT ordered.order_id, customer.firstname, customer.lastname, customer.email, customer.phone_no, customer.address, category.title as category, food.title as food, delivered, food.price, ordered.order_date FROM ordered INNER JOIN customer ON ordered.cust_id=customer.cust_id LEFT JOIN food ON ordered.food_id=food.food_id LEFT JOIN category ON food.cat_id=category.cat_id ORDER BY delivered DESC
    ";
$sel_orders_stmt = $pdo->prepare($query_sel_orders);
$sel_orders_stmt->execute();
$order_num = $sel_orders_stmt->rowCount();
$order_rows = $sel_orders_stmt->fetchAll();


// Give Me Order Report
$report_found = "false";
if (isset($_POST["order_report_form"])) {
    $year = $_POST["report_year"];
    $month = $_POST["report_month"];

    $query = "SELECT ordered.order_id, customer.firstname, customer.lastname, customer.email, customer.phone_no, customer.address, category.title as category, food.title as food, delivered, food.price, ordered.order_date FROM ordered INNER JOIN customer ON ordered.cust_id=customer.cust_id LEFT JOIN food ON ordered.food_id=food.food_id LEFT JOIN category ON food.cat_id=category.cat_id  WHERE order_date LIKE '$year-$month%' ORDER BY delivered DESC";
    $report_stmt = $pdo->prepare($query);
    $report_stmt->execute();
    $report_fetchd = $report_stmt->fetchAll();
    $report_num = $report_stmt->rowCount();
    if ($report_num == 0) {
        $report_found = "Nothing";
    } else {
        // More than zero Order Found!
        $report_found = true;
    }
}

if ($report_found == "Nothing" && $report_found !== true && $report_found != "false") {
    ?>
    <script>
        alert("Nothing Founds!");
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
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="category.php"><i class="fa fa-sitemap"></i> Category Management</a>
                    </li>
					<li>
                        <a href="food.php"><i class="fa fa-desktop"></i> Food Management</a>
					</li>
                    <li>
                        <a href="customer.php"><i class="fa fa-edit"></i> Customer Management </a>
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
					  <li class="active">Dashboard</li>
					</ol> 
									
		</div>
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
								<h3><?= $total_staff; ?></h3>
								<small>Total Staff</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-users fa-5x red"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					       <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
								<h3><?= $total_orders; ?></h3>
								<small>Total Orders</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-shopping-cart fa-5x blue"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					       <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
								<h3><?= $total_messages; ?></h3>
								<small>Total Messages</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-comments fa-5x green"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					       <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
								<h3><?= $total_customers; ?></h3>
								<small>Total Customers</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-user fa-5x yellow"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
				   
				</div> 
				
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total Orders
                                <button class="btn btn-success" data-toggle="modal" data-target="#add">
                                    Report <i class="fa fa-desktop"></i>
                                </button>
                            </div> 
                            <div class="panel-body">
                                <?php
                                // chk for the report
                                if ($report_found === true) {
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>No.</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Address</th>
                                                <th>Food Category</th>
                                                <th>Food Title</th>
                                                <th>Price</th>
                                                <th>Order Date</th>
                                                <th>Delivered</th>
                                                <th>Delete</th>
                                            </tr>
                                            <?php $x = 1; foreach ($report_fetchd as $order_row) { ?>
                                                <tr>
                                                    <td><?= $x; ?></td>
                                                    <td><?= $order_row->firstname; ?></td>
                                                    <td><?= $order_row->lastname; ?></td>
                                                    <td><?= $order_row->email; ?></td>
                                                    <td><?= $order_row->phone_no; ?></td>
                                                    <td><?= $order_row->address; ?></td>
                                                    <td><?= $order_row->category; ?></td>
                                                    <td><?= $order_row->food; ?></td>
                                                    <td><?= $order_row->price; ?></td>
                                                    <td><?= $order_row->order_date; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($order_row->delivered == "yes") {
                                                            echo "Delivered";
                                                        } else {
                                                        ?>
                                                            <a href="delivered.php?id=<?= $order_row->order_id; ?>" class="btn btn-success">Deliver</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td><a href="delete_order.php?id=<?= $order_row->order_id; ?>" class="btn btn-danger">Delete</a></td>
                                                </tr>
                                            <?php $x++; } ?>
                                        </table>
                                    </div>
                                <?php
                                } else {
                                    // report not asked (show the table)
                                    ?>
                                    <?php if ($order_num == 0) { echo "No Order Yet!"; } else { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No</th>
                                                    <th>Address</th>
                                                    <th>Food Category</th>
                                                    <th>Food Title</th>
                                                    <th>Price</th>
                                                    <th>Order Date</th>
                                                    <th>Delivered</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $x = 1; foreach ($order_rows as $order_row) { ?>
                                                    <tr>
                                                        <td><?= $x; ?></td>
                                                        <td><?= $order_row->firstname; ?></td>
                                                        <td><?= $order_row->lastname; ?></td>
                                                        <td><?= $order_row->email; ?></td>
                                                        <td><?= $order_row->phone_no; ?></td>
                                                        <td><?= $order_row->address; ?></td>
                                                        <td><?= $order_row->category; ?></td>
                                                        <td><?= $order_row->food; ?></td>
                                                        <td><?= $order_row->price; ?></td>
                                                        <td><?= $order_row->order_date; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($order_row->delivered == "yes") {
                                                                echo "Delivered";
                                                            } else {
                                                            ?>
                                                                <a href="delivered.php?id=<?= $order_row->order_id; ?>" class="btn btn-success">Deliver</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td><a href="delete_order.php?id=<?= $order_row->order_id; ?>" class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                <?php $x++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php } ?>
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
          <h4 class="modal-title">Order Report</h4>
        </div>
        <div class="modal-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Year:</label>
                <select name="report_year" class="form-control">
                    <?php $year = 2019; while ($year <= 2025) { ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php $year++; } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Month:</label>
                <select name="report_month" class="form-control">
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                </select>
              </div>

              <button type="submit" class="btn btn-success" name="order_report_form">Give Me Report</button>
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