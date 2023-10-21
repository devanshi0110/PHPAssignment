<?php
// Database connection details
$host = 'localhost';
$dbname = 'a';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Data retrieval
$query = "SELECT * FROM s";
$statement = $pdo->query($query);

if ($statement) {
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    // JSON Conversion and Output
    if ($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        die("No data found.");
    }
} else {
    die("Query failed.");
}
?>
