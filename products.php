<?php
 //start session
 session_start();

 include 'db.php';
 include 'navbar.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Our Products</h2>
  <div class="row">

    <?php
    $query = "SELECT * FROM items ";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
    ?>

    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="<?php echo $row['item_url']; ?>" class="card-img-top" alt="<?php echo $row['item_name']; ?>" style="height: 250px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo $row['item_name']; ?></h5>
          <p class="card-text"><?php echo $row['item_description']; ?></p>
          <div class="mt-auto">
            <p class="text-primary fw-bold">R<?php echo number_format($row['item_price'], 2); ?></p>
            
            <form action="add_to_cart.php" method="POST">
              <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
              <button type="submit" class="btn btn-success w-100">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
      endwhile;
    else:
      echo "<p>No products available.</p>";
    endif;
    ?>
  </div>
</div>

</body>
</html>
