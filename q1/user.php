<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ulogin.php'); // Redirect to the login page if not logged in
    exit();
}

$username = $_SESSION['username'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "a");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the list of products from the database
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <p><a href="logout1.php">Logout</a></p>

    <h3>Product List</h3>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['pid'] . "</td>";
                echo "<td><img src='" . $row['img'] . "' alt='" . $row['name'] . "'></td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>$" . $row['price'] . "</td>";
                echo "<td><button>Add to Cart</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
