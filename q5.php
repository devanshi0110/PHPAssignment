<?php
// Define the API endpoint URL
$apiUrl = 'http://localhost:9000/';

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options for a GET request
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the GET request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Handle the API response
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($httpCode == 200) {
        // API request was successful
        echo 'API Response: ' . $response;
    } else {
        // API request failed with a non-200 status code
        echo 'API Request Failed with HTTP Status Code ' . $httpCode;
    }
}

// Close cURL session
curl_close($ch);
?>
