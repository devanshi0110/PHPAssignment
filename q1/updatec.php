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

    // Step 3: Check if the form has been submitted for category update
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_category_name = $_POST['new_category_name'];

        // Step 4: Update the category in the database
        $sql = "UPDATE category SET cname = '$new_category_name' WHERE cid = $category_id";

        if (mysqli_query($conn, $sql)) {
            echo "Category updated successfully.";
            header('Location: admin.php');
        } else {
            echo "Error updating category: " . mysqli_error($conn);
            header('Location: admin.php');
        }
    }

    // Step 5: Retrieve the current category name for the category ID
    $sql = "SELECT cname FROM category WHERE cid = $category_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_category_name = $row['cname'];
}

// Step 6: Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Category</title>
</head>
<body>
    <h2>Update Category</h2>
    <?php if (isset($current_category_name)) { ?>
        <form method="post" action="">
            <label for="new_category_name">New Category Name:</label>
            <input type="text" name="new_category_name" id="new_category_name" value="<?php echo $current_category_name; ?>" required><br><br>
            <input type="submit" value="Update Category">
        </form>
    <?php } else {
        echo "Category not found.";
    } ?>
</body>
</html>
