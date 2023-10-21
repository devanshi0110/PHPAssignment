<?php
$directory = 'D:\Assignment2'; // Replace with the path to the directory you want to list files from

// Check if the directory exists and is readable
if (is_dir($directory) && is_readable($directory)) {
    $files = scandir($directory);

    // Loop through the files and directories
    foreach ($files as $file) {
        // Exclude . and .. (current directory and parent directory) from the list
        if ($file != "." && $file != "..") {
            echo $file . "<br>";
        }
    }
} else {
    echo "The directory does not exist or is not readable.";
}
?>
