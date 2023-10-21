<?php
session_start();

// Check if the user is authenticated (the username is stored in the session)
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "a";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Retrieve the categories from the database
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Step 3: Display the categories in a table with "Delete" and "Update" links
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <h2>Categories</h2>
    <table border="1">
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['cid'] . "</td>";
            echo "<td>" . $row['cname'] . "</td>";
            echo "<td><a href='updatec.php?id=" . $row['cid'] . "'>Update</a> | <a href='deletec.php?id=" . $row['cid'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p><a href="cat.php">Add New Category</a></p><p><a href="pro.php">Products</a></p><p><a href="logout.php">Logout</a></p>
</body>
</html>
