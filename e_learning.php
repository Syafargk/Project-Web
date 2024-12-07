<?php
// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'e_learning_db');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil mata kuliah dari URL
$mata_kuliah = isset($_GET['mata_kuliah']) ? $_GET['mata_kuliah'] : 'Fisika'; // Default ke Fisika jika tidak ada parameter
$sql = "SELECT * FROM uploads WHERE mata_kuliah='$mata_kuliah'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning <?php echo htmlspecialchars($mata_kuliah); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Materi <?php echo htmlspecialchars($mata_kuliah); ?></h1>

        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <a href="uploads/<?php echo htmlspecialchars($row['file_name']); ?>" target="_blank">
                            <?php echo htmlspecialchars($row['file_name']); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Tidak ada file yang diunggah.</p>
        <?php endif; ?>

    </div>
</body>

</html>

<?php $conn->close(); ?>