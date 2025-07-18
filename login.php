<?php
    //start session
    session_start();

    include 'db.php';
    include 'navbar.php';

    $message = " ";

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = ($_POST['username']);
        $password = ($_POST['password']);

        if (empty($username) || empty($password)) {
        $message = "Please fill in all fields.";
    } else {
            $query = "SELECT user_id, password name FROM users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($user_id, $stored_password);
                $stmt->fetch();

                if ($password === $stored_password) {
                    // Login successful
                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["username"] = $username;
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Incorrect password.";
                }
            } else {
                $message = "No user found with that username.";
            }

            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shodow-lg">
            <div class="card-body">
                <h3 class="text-center card-title-mb-4">Login</h3>

                    <?php if (!empty($message)): ?>
                         <div class="alert alert-warning"><?php echo $message; ?></div>
                    <?php endif; ?>

                <form action="login.php" method="post">
                    <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                    </div>

                    <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" >Login</button>
                </form>

                <p class="mt-3">Don't have an account? <a href="register.php">Register here</a>.</p>

            </div>
        </div>
    </div>
</body>
</html>