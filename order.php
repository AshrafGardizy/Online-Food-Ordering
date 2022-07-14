<?php

require_once("connection.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    echo "user: " . $_SESSION["logged_in"] . "<br>Food id: " . $id;

    $query = "INSERT INTO ordered(cust_id, food_id) VALUES(:cust_id, :food_id)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        "cust_id"=>$_SESSION["logged_in"],
        "food_id"=>$id
    ]);
    ?>
    <script>
        alert("Thanks For Your Ordering!\nWe will Proceed as Soon as Possible.");
        window.location.assign("myOrders.php");
    </script>
    <?php
}

?>