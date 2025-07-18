<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST["name"]);
    $email   = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $msg     = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($msg)) {
        $message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } else {
        // Normally you'd send an email or save to DB here
        $message = "Thanks for contacting us, $name! We'll get back to you soon.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <div class="text-center mb-4">
    <h1>Contact Us</h1>
    <p class="text-muted">We’d love to hear from you! Please fill out the form below.</p>
  </div>

  <?php if (!empty($message)): ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="contact.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Full Name *</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email Address *</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Subject</label>
          <input type="text" name="subject" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Message *</label>
          <textarea name="message" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
    </div>
  </div>
</div>

<!-- Optional Footer -->
<footer class="text-center mt-5 mb-3 text-muted">
  &copy; 2025 LifeChoice . All rights reserved.
</footer>

</body>
</html>
