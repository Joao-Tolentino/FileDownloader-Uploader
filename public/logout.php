<?php
session_start();

// Do not display errors in page
ini_set('display_errors', 0);

// Unset all variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login
header("Location: index.php");
exit;
?>