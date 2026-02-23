<?php
require_once __DIR__ .  "/../includes/auth.php";

// Do not display errors in page
ini_set('display_errors', 0);

// Define the user and path variables in the scope
$user = $_SESSION['user'];
$storagePath = __DIR__ . "/../storage/" . $user . "/";

// Create folder if it missing
if (!is_dir($storagePath)){
    mkdir($storagePath,0777, true);
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    // Check if file is selected
    if (!isset($_FILES["file"])){
        die("NO file uploaded.");
    }

    // Return possible error to the user. Debug tool
    if ($_FILES["file"]["error"] !== 0){
        die("Upload error.");
    }

    // Limit file size to 10MB
    $maxSize = 10 * 1024 * 1024;
    if ($_FILES["file"]["size"] > $maxSize) {
        die("File exceeds 10MB");
    }

    // Get name of the file
    $originalName = basename($_FILES["file"]["name"]);

    // Generate a unique and safe file name for storing
    $newName = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $originalName);
    $targetFile = $storagePath . $newName;

    // Move file to the correct storage folder
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        header("Location: dashboard.php");
        exit;
    } else{
        die("Failed to move uploaded file.");
    }
}
?>