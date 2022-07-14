<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM admin WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: staff.php?staffDeletedSuccessfully");
} else header("location: staff.php")

?>