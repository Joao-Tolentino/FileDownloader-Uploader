<?php
// Start a session and checks the "users" credentials
session_start();

// Do not display errors in page
ini_set('display_errors', 0);

// Force auth in the landing page and access through it
if(!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
?>