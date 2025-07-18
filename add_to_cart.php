<?php
session_start();
include "db.php";
include "navbar.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Check if item_id is passed via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item_id"])) {
    $user_id = $_SESSION["user_id"];
    $item_id = (int)$_POST["item_id"];

    // Check if item already exists in the cart
    $check = $conn->prepare("SELECT cart_id FROM cart WHERE user_id = ? AND item_id = ?");
    $check->bind_param("ii", $user_id, $item_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        // Insert new cart item
        $insert = $conn->prepare("INSERT INTO cart (user_id, item_id) VALUES (?, ?)");
        $insert->bind_param("ii", $user_id, $item_id);
        $insert->execute();
    }

    // Redirect to cart
    header("Location: cart.php");
    exit();
} else {
    // Invalid access
    header("Location: products.php");
    exit();
}
?>
