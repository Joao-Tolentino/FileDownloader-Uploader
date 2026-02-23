<?php
require_once __DIR__ .  "/../includes/auth.php";

// Do not display errors in page
ini_set('display_errors', 0);

// Define the user and path variables in the scope
$user = $_SESSION["user"];
$storagePath = __DIR__ . "/../storage/" . $user . "/";

// Create folder in storage in case it doesnt exist
if (!is_dir($storagePath)){
    mkdir($storagePath,0777, true);
}

// Upload handle
if (isset($_POST["upload"])) {
    if($_FILES["file"]["error"] === 0) {
        $originalName = basename($_FILES["file"]["name"]);
        $newName = uniqid() . "_" . $originalName;
        $targetFile = $storagePath . $newName;

        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
    }
}

// Get Files list in storage and display in the page
$files = array_diff(scandir($storagePath),array('.','..'));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; background: #f4f4f4; }
        .container {
            width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { margin-top: 0; }
        ul { list-style: none; padding: 0; }
        li { margin: 8px 0; }
        a { text-decoration: none; color: blue; }
        .top-bar { display: flex; justify-content: space-between; }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h2>Welcome, <?= htmlspecialchars($user) ?></h2>
        <a href="logout.php">Logout</a>
    </div>

    <hr>

    <h3>Upload File</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit" name="upload">Upload</button>
    </form>

    <hr>

    <h3>Your Files</h3>
    <ul>
        <?php foreach ($files as $file): ?>
            <li>
                <?= htmlspecialchars($file) ?> 
                - <a href="download.php?file=<?= urlencode($file) ?>">Download</a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

</body>
</html>