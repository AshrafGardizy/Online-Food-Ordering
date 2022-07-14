<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM ordered WHERE order_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: index.php?orderDeletedSuccessfully");
} else header("location: index.php")

?>