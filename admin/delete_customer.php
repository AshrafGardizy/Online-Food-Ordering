<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM customer WHERE cust_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: customer.php?customerDeletedSuccessfully");
} else header("location: customer.php")

?>