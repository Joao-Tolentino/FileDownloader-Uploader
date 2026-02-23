<?php
require_once __DIR__ .  "/../includes/auth.php";

// Do not display errors in page
ini_set('display_errors', 0);


// Define the user and path variables in the scope
$user = $_SESSION['user'];
$storagePath = __DIR__ . "/../storage/" . $user . "/";

// If no file present, return error to the user
if (!isset($_GET["file"])) {
    die("No file specified.");
}

// Prevent directory traversal
$file = basename($_GET["file"]);
$filePath = $storagePath . $file;

// If inexistent file is selected, pass to user
if (!file_exists($filePath)) {
    die("File not found.");
}

// Force download
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . $file . "\"");
header("Content-Length: " . filesize($filePath));
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

readfile($filePath);
exit;
?>