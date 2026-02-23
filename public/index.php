<?php
// Start session and dont pass errors to page
session_start();
require_once  __DIR__ . "/../includes/config.php";

// Do not display errors in page
ini_set('display_errors', 0);

$error = "";

// Check the user credentials in the login page, uses hash for password 
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (isset($users[$username]) && password_verify($password, $users[$username])){
        $_SESSION["user"] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Share Login</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; background: #f4f4f4; text-align: center; }
        .box {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input { width: 90%; padding: 8px; margin: 8px 0; }
        button { padding: 8px 15px; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="box">
    <h2>Login</h2>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>