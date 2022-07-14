<?php

require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM contact WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("location: msg.php?msgDeletedSuccessfully");
} else header("location: msg.php")

?>