<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "a";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Check if a category ID is provided via the "id" query parameter
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Step 3: Delete the category from the database
    $sql = "DELETE FROM category WHERE cid = $category_id";

    if (mysqli_query($conn, $sql)) {
        echo "Category deleted successfully.";     
        header('Location: admin.php');
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
