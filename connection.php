<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "yummy";

// Set DSN
$dsn = "mysql:host=$host; dbname=$database";

// PDOStatement::execute(): SQLSTATE[HY093]: Invalid parameter number: parameter was not defined in C:\xampp\htdocs\yummy\connection.php on line 33

// Create PDO Obj
$pdo = new PDO($dsn, $user, $password);
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// set the fetch mode
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// Start the Session
session_start();

//name="user_got_signup"
if (isset($_POST["user_got_signup"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone_no = $_POST["phone_no"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dob_y = $_POST["dob_y"];
    $address = $_POST["address"];

    // current_timestamp()
    // Insert Data
    try {
        $query = "
        INSERT INTO customer(firstname, lastname, email, `password`, phone_no, address, dob_y)
                     VALUES(:firstname, :lastname, :email, :password, :phone_no, :address, :dob_y)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            "firstname"=>$firstname,
            "lastname"=>$lastname,
            "email"=>$email,
            "password"=>md5($password),
            "phone_no"=>$phone_no,
            "address"=>$address,
            "dob_y"=>$dob_y
        ]);
        $last_id = $pdo->lastInsertId();
        $_SESSION["logged_in"] = $last_id;
        ?>
            <script>
                alert("Hey Dear!\nNow You can Order!");
            </script>
        <?php
    } catch (PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
}

// Login form
if (isset($_POST["user_got_login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM customer WHERE email=:email AND `password`=:password";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        "email"=>$email,
        "password"=>md5($password)
    ]);
    $rowCount = $stmt->rowCount();
    if ($rowCount > 0) {
        $logged_in = $stmt->fetch();
        $logged_in = $logged_in->cust_id . "<br>";
        $_SESSION["logged_in"] = $logged_in;
        ?>
            <script>
                alert("Hi!\nNow You Can Order!");
            </script>
        <?php
    } else {
        ?>
            <script>
                alert("Sorry!\nIncorrect email or password!");
            </script>
        <?php
    }
}

// Contact Form
if (isset($_POST["Name"]) && isset($_POST["Email"]) && isset($_POST["phone"]) && isset($_POST["Message"])) {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $phone = $_POST["phone"];
    $msg = $_POST["Message"];

    $query_ins_contact = "INSERT INTO contact(name, email, phone, msg) VALUES(:name, :email, :phone, :msg)";
    $contact_prepare = $pdo->prepare($query_ins_contact);
    $contact_prepare->execute([
        "name"=>$name,
        "email"=>$email,
        "phone"=>$phone,
        "msg"=>$msg
    ]);
    ?>
        <script>
            alert("Thank for your feedback!");
        </script>
    <?php
}

?>