<?php
session_start();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if both the username and password are "admin"
    if ($username === 'admin' && $password === 'admin') {
        // Authentication successful
        $_SESSION['username'] = $username;
        header('Location: admin.php');
        exit();
    } else {
        // Authentication failed
        $error = "Login failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
</body>
</html>
