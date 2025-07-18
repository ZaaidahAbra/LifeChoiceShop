<?php
session_start();
 include 'db.php';

 if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cart_id"])) {
    $cart_id = (int)$_POST["cart_id"];

    // Ensure this cart item belongs to the logged-in user
    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
}

header("Location: cart.php");
exit();
