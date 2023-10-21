<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username1 = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "a");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to check both username and password
    $sql = "SELECT * FROM user WHERE email = '$username1' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username1; // Store the username in the session
        header('Location: user.php'); // Redirect to a welcome page
    } else {
        echo "Login failed. Please try again.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" name="login" value="Login">
    </form>
    <p><a href="registration.php">Register</a></p>
</body>
</html>
