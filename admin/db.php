<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "yummy";

// Set the DSN
$dsn = "mysql:host=$host; dbname=$database";

// Create the PDO Obj
$pdo = new PDO($dsn, $user, $password);
// Set PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Set the Fetch Mode to Obj
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// Start the session
session_start();

// Admin Login
$rowCount = "null";
if (isset($_POST["admin_got_login"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $query = "SELECT * FROM admin WHERE email=:email AND password=:password";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        "email" => $email,
        "password" => $password
    ]);
    $data = $stmt->fetch();
    $rowCount = $stmt->rowCount();
    if ($rowCount > 0) {
        $_SESSION["admin_logged_in"] = $data->id;
        header("location: index.php");
    }
}

// admin_profile_got_update
if (isset($_POST["admin_profile_got_update"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone_no = $_POST["phone_no"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $query_update_profile = "UPDATE admin SET firstname=?, lastname=?, phone=?, email=?, password=? WHERE id=".$_SESSION["admin_logged_in"];
    $stmt = $pdo->prepare($query_update_profile);
    $stmt->execute([
        $firstname, $lastname, $phone_no, $email, $password
    ]);
    ?>
    <script>
        alert("Your profile has been changed successfully!");
        window.location.assign("index.php");
    </script>
    <?php
}

if (isset($_SESSION["admin_logged_in"])) {
    // Select Current Admin Logged in
    $sel_admin_data = "SELECT * FROM admin WHERE id=".$_SESSION["admin_logged_in"];
    $sel_admin_data_prepare = $pdo->prepare($sel_admin_data);
    $sel_admin_data_prepare->execute();
    $sel_admin_data_row = $sel_admin_data_prepare->fetch();
}

?>
<!-- Modal -->
<div class="modal fade" id="userProfile" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Profile</h4>
        </div>
        <div class="modal-body">
            <form method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?= $sel_admin_data_row->firstname; ?>" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?= $sel_admin_data_row->lastname; ?>" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="phone_no" placeholder="Phone No" value="<?= $sel_admin_data_row->phone; ?>" required="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $sel_admin_data_row->email; ?>" required="">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="">
              </div>
              <button type="submit" class="btn btn-success" name="admin_profile_got_update">Save Changes</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- //Profile Modal -->


<?php
// Couting (staff, orders, messages, customers)
$query_total_staff = "SELECT * FROM admin";
$prepare_total_staff = $pdo->prepare($query_total_staff);
$prepare_total_staff->execute();
$total_staff = $prepare_total_staff->rowCount();

$query_total_orders = "SELECT * FROM ordered";
$prepare_total_orders = $pdo->prepare($query_total_orders);
$prepare_total_orders->execute();
$total_orders = $prepare_total_orders->rowCount();

$query_total_messages = "SELECT * FROM contact";
$prepare_total_messages = $pdo->prepare($query_total_messages);
$prepare_total_messages->execute();
$total_messages = $prepare_total_messages->rowCount();

$query_total_customers = "SELECT * FROM customer";
$prepare_total_customers = $pdo->prepare($query_total_customers);
$prepare_total_customers->execute();
$total_customers = $prepare_total_customers->rowCount();

