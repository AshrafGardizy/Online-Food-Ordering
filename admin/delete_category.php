<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM category WHERE cat_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: category.php?categoryDeletedSuccessfully");
} else header("location: category.php")

?>