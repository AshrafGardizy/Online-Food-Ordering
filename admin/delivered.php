<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "UPDATE ordered SET delivered='yes' WHERE order_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: index.php?deliveredDeletedSuccessfully");
} else header("location: index.php")

?>