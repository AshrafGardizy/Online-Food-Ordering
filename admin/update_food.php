<?php
require_once("db.php");

// Chk if the user logged_in
if (!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
}

// Update New Food
if (isset($_POST["update_food_form"])) {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $type = $_POST["type"];
    $cat_id = $_POST["cat_id"];
    $food_location = $_POST["food_location"];
    $food_cond = $_POST["food_cond"];
    $brand = $_POST["brand"];
    $source = $_FILES["photo"]["tmp_name"];
    $destination = time() . $_FILES["photo"]["name"];

    if (move_uploaded_file($source, "../images/foods/" . $destination)) {
        $query = "UPDATE food SET title=:title, photo=:photo, price=:price, type=:type, cat_id=:cat_id, food_location=:food_location, food_cond=:food_cond, brand=:brand WHERE food_id=:food_id";
        $stmt = $pdo->prepare($query);
        $execute = $stmt->execute([
            "title"=>$title,
            "photo"=>"images/foods/" . $destination,
            "price"=>$price,
            "type"=>$type,
            "cat_id"=>$cat_id,
            "food_location"=>$food_location,
            "food_cond"=>$food_cond,
            "brand"=>$brand,
            "food_id"=>$_GET["id"]
        ]);
        ?>
        <script>
            alert("Food Updated Successfully!");
            window.location = "food.php";
        </script>
        <?php
    } else {
        // Error Uploading File
        ?>
        <script>
            alert("Error Uploading Photo!\nTry Again!");
            window.location = "food.php";
        </script>
        <?php
    }
}

// Select Foods
$query_sel_food = "SELECT * FROM food WHERE food_id=:id";
$sel_food_prepare = $pdo->prepare($query_sel_food);
$sel_food_prepare->execute(["id"=>$_GET["id"]]);
$food_num = $sel_food_prepare->rowCount();
$food_row = $sel_food_prepare->fetch();

// Select Category
$query_sel_cat = "SELECT * FROM category";
$sel_cat_prepare = $pdo->prepare($query_sel_cat);
$sel_cat_prepare->execute();
$cat_rows = $sel_cat_prepare->fetchAll();

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
                        <a class="active-menu" href="food.php"><i class="fa fa-desktop"></i> Food Management</a>
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
					  <li>Dashboard</li>
                      <li class="active">Update Food</li>
					</ol> 
									
		</div>
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Update Food
                            </div> 
                            <div class="panel-body">
                                
                                <form method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $food_row->title; ?>" name="title" placeholder="Enter Food Title" required="">
                                  </div>
                                  <div class="form-group">
                                    <input type="file" class="form-control" name="photo" required="">
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $food_row->price; ?>" name="price" placeholder="Enter Food Price" required="">
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $food_row->type; ?>" name="type" placeholder="Enter Food Type" required="">
                                  </div>
                                  <div class="form-group">
                                      <select class="form-control" name="cat_id">
                                        <?php foreach ($cat_rows as $cat_row) { ?>
                                          <option value="<?= $cat_row->cat_id; ?>"><?= $cat_row->title; ?></option>
                                        <?php } ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $food_row->food_location; ?>" name="food_location" placeholder="Enter Food Location" required="">
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $food_row->food_cond; ?>" name="food_cond" placeholder="Enter Food Condition" required="">
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $food_row->brand; ?>" name="brand" placeholder="Enter Food Brand" required="">
                                  </div>

                                  <button type="submit" class="btn btn-success" name="update_food_form">Save Changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
			
		
				<footer><p>All right reserved. Developed by: <b> Ashraf Gardizy</b></p>
				
        
				</footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

<!-- Add Category Modal -->
<div class="modal fade" id="add" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Food</h4>
        </div>
        <div class="modal-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Enter Food Title" required="">
              </div>
              <div class="form-group">
                <input type="file" class="form-control" name="photo" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="price" placeholder="Enter Food Price" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="type" placeholder="Enter Food Type" required="">
              </div>
              <div class="form-group">
                  <select class="form-control" name="cat_id">
                    <?php foreach ($cat_rows as $cat_row) { ?>
                      <option value="<?= $cat_row->cat_id; ?>"><?= $cat_row->title; ?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="food_location" placeholder="Enter Food Location" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="food_cond" placeholder="Enter Food Condition" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="brand" placeholder="Enter Food Brand" required="">
              </div>

              <button type="submit" class="btn btn-success" name="add_food_form">Add</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- //AddCategory Modal -->


    <!-- /. WRAPPER  -->
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