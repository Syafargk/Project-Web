<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/style-admin.css">
</head>

<body>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <a href="upload.php">Unggah File</a> |
        <a href="daftar_hadir.php">Lihat Daftar Hadir</a> |
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>