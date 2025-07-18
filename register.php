<?php
 //start session
 session_start();

 include 'db.php';
 include 'navbar.php';

    //Handle form submission
 $message ="";

 if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username =  ($_POST['username']);
    $password =($_POST['password']);

    //validation
    if (empty($username) || empty($password)) {
        $message = "All fields are required.";
    } else {
        // Check for duplicate email
        $query = "SELECT user_id FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Username is already registered.";
        } else {
            // Insert user
            $insert = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("ss", $username, $password);
            
            if ($stmt->execute()) {
                $message = "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                $message = "Something went wrong. Try again.";
            }
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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="text-center card-title-mb-4">Register</h3>

                     <?php if (!empty($message)): ?>
                       <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <form action="register.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" >Register</button>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>