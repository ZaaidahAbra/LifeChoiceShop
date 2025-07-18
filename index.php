<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LifeChoice Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .hero {
      background: url('https://speedy.uenicdn.com/57b606b3-689a-4f68-abd9-0379f33f19ef/c876_a/image/upload/v1694607542/business/3b4d271a8c8047e1bf17365593dbcc5d.png') no-repeat center center;
      background-size: cover;
      height: 90vh;
      color: white;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .hero-overlay {
      background: rgba(0, 0, 0, 0.6);
      padding: 40px;
      border-radius: 10px;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.2rem;
      margin-top: 1rem;
    }
  </style>

</head>
<body>

<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<div class="hero">
  <div class="hero-overlay">
    <h1>Welcome to LifeChoice Shop</h1>
    <p>Browse out product selection below</p>
    <a href="products.php" class="btn btn-warning mt-3">Browse Products</a>
  </div>
</div>

<!-- Footer -->
<footer class="text-center mt-5 mb-3 text-muted">
  &copy; 2025 LifeChoice Shop. All rights reserved.
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
