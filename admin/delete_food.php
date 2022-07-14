<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM food WHERE food_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: food.php?foodDeletedSuccessfully");
} else header("location: food.php")

?>