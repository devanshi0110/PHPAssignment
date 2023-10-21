<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "a";
$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$query = "SELECT * FROM s";
$result=$mysqli->query($query);
$xml = new SimpleXMLElement('<students></students>');

// Iterate through the result set and add each student's data to the XML
while ($row = $result->fetch_assoc()) {
    $student = $xml->addChild('student');
    $student->addChild('id', $row['id']);
    $student->addChild('name', $row['name']);
    $student->addChild('age', $row['age']);
    // Add more fields as needed
}

// Save the XML to a file (students.xml)
$xml->asXML('students.xml');

// Close the database connection
$mysqli->close();

echo "Data has been successfully exported to students.xml.";
?>