<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mata_kuliah = $_POST['mata_kuliah'];
    $file = $_FILES['file'];

    // Direktori upload
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Simpan file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Simpan informasi ke database
        $conn = new mysqli('localhost', 'root', '', 'e_learning_db');
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "INSERT INTO uploads (file_name, file_type, mata_kuliah) 
                VALUES ('" . basename($file["name"]) . "', '$file_type', '$mata_kuliah')";

        if ($conn->query($sql) === TRUE) {
            echo "File berhasil diunggah.";
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Gagal mengunggah file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Unggah File untuk Mata Kuliah</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="mata_kuliah">Pilih Mata Kuliah:</label>
            <select name="mata_kuliah" id="mata_kuliah" required>
                <option value="Fisika">Fisika</option>
                <option value="Matematika">Matematika</option>
                <option value="Kimia">Kimia</option>
                <option value="Biologi">Biologi</option>
            </select>

            <label for="file">Pilih File (Video/Dokumen):</label>
            <input type="file" name="file" id="file" required>

            <button type="submit">Unggah</button>
        </form>
    </div>
</body>

</html>