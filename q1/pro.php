<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "a";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT p.pid, p.name, p.price, p.qty, p.img, c.cname 
        FROM product p
        JOIN category c ON p.cid = c.cid";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <h2>Product List</h2>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Category</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['pid'] . "</td>";
            echo "<td>" . $row['cname'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['qty'] . "</td>";
            echo "<td><img src='" . $row['img'] . "' alt='" . $row['name'] . "' width='100' height='100'></td>";           
            echo "</tr>";
        }
        ?>
    </table>
    <p><a href="product.php">Add New Product</a></p>
</body>
</html>
