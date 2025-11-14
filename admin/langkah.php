<?php
include('../koneksi/koneksi.php');
session_start();

if (isset($_GET['id'])) {
    $id_info_resep = intval($_GET['id']);
} else {
    echo "ID tidak tersedia.";
    exit();
}

$resep = null;
$langkah_makanan = [];


if (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];

    $sql_resep = "SELECT gambar, alat, bahan, langkah FROM langkah WHERE id_info_resep = ?";
    $stmt_resep = mysqli_prepare($koneksi, $sql_resep);
    mysqli_stmt_bind_param($stmt_resep, "i", $id_info_resep);
    mysqli_stmt_execute($stmt_resep);
    $result_resep = mysqli_stmt_get_result($stmt_resep);
    if ($result_resep && mysqli_num_rows($result_resep) > 0) {
        while ($data = mysqli_fetch_assoc($result_resep)) {
            $langkah_makanan[] = [
                'gambar' => $data['gambar'],
                'alat' => $data['alat'],
                'bahan' => $data['bahan'],
                'langkah' => $data['langkah'],
            ];
        }
    }
}
?>
<!DOCTYPE html>

<head>
    <?php include("includes/head.php") ?>
    <title>Profil - MasaKin!</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div id="sidebar">
        <?php include 'includes/sidebar.php'; ?>
    </div>
    <div id="overlay" onclick="toggleSidebar()"></div>

    <nav>
        <div class="hamburger" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
        <div class="nav-container">
            <a href="home.php"><i class="fas fa-home"></i></a>
            <a href="favorit.php"><i class="fas fa-heart"></i></a>
            <a href="medsos.php"><i class="fas fa-globe"></i></a>
            <a href="feedback.php"><i class="fas fa-envelope"></i></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <?php foreach ($langkah_makanan as $index => $item) { ?>
        <div class="card-kelola">
            <div class="gambar-langkah">
                <img src="../admin/image/<?php echo $item['gambar']; ?>">
            </div>
            <div class="label-langkah-mami">
                <h4>LANGKAH-<?php echo $index + 1; ?></h4>
            </div>
            <div class="about-mami-langkah">
                <div>
                    <div class="label-alatbahan">
                        <h6>BAHAN-BAHAN</h6>
                    </div>
                    <div>
                        <?php echo nl2br($item['bahan']); ?>
                    </div>
                </div>
                <div>
                    <div class="label-alatbahan">
                        <h6>ALAT-ALAT</h6>
                    </div>
                    <div>
                        <?php echo nl2br($item['alat']); ?>
                    </div>
                </div>
                <div>
                    <div class="label-alatbahan">
                        <h6>LANGKAH-LANGKAH</h6>
                    </div>
                    <div>
                        <?php echo nl2br($item['langkah']); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <div class="tombol-finish">
        <a href="ulasan.php?id=<?php echo $id_info_resep; ?>">
            <button class="button-finish" type="submit">FINISH</button>
        </a>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
        }
    </script>
    </div>



    <?php include("includes/script.php") ?>

</body>

</html>