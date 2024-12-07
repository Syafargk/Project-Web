<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_learning_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$nnim = $_POST['nnim'];
$status = $_POST['status'];
$mata_kuliah = $_POST['mata_kuliah'];
$tanggal = date('Y-m-d');  // Tanggal saat ini
$jam = date('H:i:s');  // Jam saat ini

// Simpan data ke tabel absensi
$sql = "INSERT INTO absensi (nama, nnim, status, mata_kuliah, tanggal, jam)
        VALUES ('$nama', '$nnim', '$status', '$mata_kuliah', '$tanggal', '$jam')";

if ($conn->query($sql) === TRUE) {
    echo "Absensi berhasil disimpan untuk Mata Kuliah: $mata_kuliah";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>