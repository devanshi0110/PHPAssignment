<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "a";
$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Load and parse the XML file
$xml = simplexml_load_file('students.xml');

if ($xml === false) {
    die("Failed to load XML file.");
}

// Iterate through the XML data and insert it into the MySQL table
foreach ($xml->student as $student) {
    $id = (int)$student->id;
    $name = $mysqli->real_escape_string((string)$student->name);
    $age = (int)$student->age;
    
    // Insert data into the students table
    $query = "INSERT INTO s (id, name, age) VALUES ($id, '$name', $age)";
    
    if ($mysqli->query($query) === false) {
        echo "Error inserting data for student with ID $id: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();

echo "Data has been successfully imported from students.xml to the students table.";
?>
