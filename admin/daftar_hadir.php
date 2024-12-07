<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'e_learning_db');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data absensi
$sql = "SELECT * FROM absensi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir</title>
    <link rel="stylesheet" href="../css/style-admin.css">
</head>

<body>
    <div class="container">
        <h1>Daftar Hadir Mahasiswa</h1>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NNIM</th>
                    <th>Status</th>
                    <th>Mata Kuliah</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['nnim']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['mata_kuliah']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td><?php echo htmlspecialchars($row['jam']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Tidak ada data absensi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>

</html>

<?php $conn->close(); ?>