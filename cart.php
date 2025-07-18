<?php
session_start();
include 'db.php';
include 'navbar.php';

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$cart_items = [];
$total_price = 0;

// Fetch cart data (assuming no quantity column)
$query = "
    SELECT 
        c.cart_id,
        i.item_name,
        i.item_price,
        i.item_url
    FROM cart c
    JOIN items i ON c.item_id = i.item_id
    WHERE c.user_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_price += $row["item_price"];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Your Shopping Cart</h2>

    <?php if (empty($cart_items)): ?>
        <div class="alert alert-info">Your cart is empty. <a href="products.php">Browse products</a></div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th style="width: 350px;" >Product</th>
                    <th style="width: 150px;">Image</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?php echo ($item["item_name"]); ?></td>
                    <td><img src="<?php echo $item["item_url"]; ?>" style="height: 150px;"></td>
                    <td> R <?php echo number_format($item["item_price"], 2); ?></td>
                    <td>
                        <form action="remove_from_cart.php" method="POST" onsubmit="return confirm('Remove this item?');">
                            <input type="hidden" name="cart_id" value="<?php echo $item["cart_id"]; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="text-end">Total: R<?php echo number_format($total_price, 2); ?></h4>
        <div class="text-end">
            <button class="btn btn-primary">Proceed to Checkout</button>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
