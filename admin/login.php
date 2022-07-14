<?php

// Login Page
require_once("db.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
    <style type="text/css">
        body {
            background: #ededed;
        }
        .panel {
            margin-top: 40%;
        }
    </style>
</head>
<body>

<div class="col-md-4 padding-5">
    
</div>

<div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading text-center">Welcome to Admin Login Page</div>
      <div class="panel-body">
        <form method="post">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter the Email">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter the Password">
          </div>
          <button type="submit" class="btn btn-default" name="admin_got_login">Login</button>
        </form>
      </div>
        <?php if ($rowCount == 0) { ?>
          <div class="panel-footer">Please Enter a Valid Email and Password!</div>
        <?php } ?>

    </div>
</div>

</body>
</html>