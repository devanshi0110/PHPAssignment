<!DOCTYPE html>
<html>
<head>
    <title>Insert Product</title>
</head>
<body>
    <h2>Insert Product</h2>
    <form method="post"
     enctype="multipart/form-data">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "a";
            
            $conn = mysqli_connect($servername, $username, $password, $database);
            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['cid'] . "'>" . $row['cname'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="qty">Quantity:</label>
        <input type="number" name="qty" id="qty" required><br><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" required><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>

        <input type="submit" value="Insert Product">
    </form>
</body>
</html>
<?php
//include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid = $_POST['category'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        // File uploaded successfully
        $image = $targetFile;

        // Insert the product into the database
        $sql = "INSERT INTO product (cid, name, qty, price, img) VALUES ($cid, '$name', $qty, $price, '$image')";

        if (mysqli_query($conn, $sql)) {
            echo "Product inserted successfully.";
            header('Location: admin.php');
        } else {
            echo "Error inserting product: " . mysqli_error($conn);
            header('Location: pro.php');
        }
    } else {
        echo "Error uploading the image.";
    }
}
?>
