<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nnim = $_POST['nnim'];
    $status = $_POST['status'];
    $mata_kuliah = $_POST['mata_kuliah'];
    $tanggal = date('Y-m-d');
    $jam = date('H:i:s');

    // Koneksi database
    $conn = new mysqli('localhost', 'root', '', 'e_learning_db');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO absensi (nama, nnim, status, mata_kuliah, tanggal, jam) 
            VALUES ('$nama', '$nnim', '$status', '$mata_kuliah', '$tanggal', '$jam')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman e-learning berdasarkan mata kuliah
        header("Location: e_learning.php?mata_kuliah=" . urlencode($mata_kuliah));
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Form Absensi</h1>
        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="nnim">NIM:</label>
            <input type="text" name="nim" id="nim" required>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Hadir">Hadir</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
            </select>

            <label for="mata_kuliah">Mata Kuliah:</label>
            <select name="mata_kuliah" id="mata_kuliah" required>
                <option value="Fisika">Fisika</option>
                <option value="Matematika">Matematika</option>
                <option value="Kimia">Kimia</option>
                <option value="Biologi">Biologi</option>
            </select>

            <button type="submit">Kirim</button>
        </form>
    </div>
</body>

</html>k