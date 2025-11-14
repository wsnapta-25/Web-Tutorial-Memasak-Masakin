<?php
include('../koneksi/koneksi.php');
session_start();

if (isset($_GET['id'])) {
    $id_info_resep = intval($_GET['id']);
} else {
    echo "ID tidak tersedia.";
    exit();
}

$ulasan_makanan = [];


if (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];

    $sql_resep = "select gambar_penutup from info_resep where id_info_resep = ?";
    $stmt_resep = mysqli_prepare($koneksi, $sql_resep);
    mysqli_stmt_bind_param($stmt_resep, "i", $id_info_resep);
    mysqli_stmt_execute($stmt_resep);
    $result_resep = mysqli_stmt_get_result($stmt_resep);
    if ($result_resep && mysqli_num_rows($result_resep) > 0) {
        while ($data = mysqli_fetch_assoc($result_resep)) {
            $ulasan_makanan[] = [
                'gambar_penutup' => $data['gambar_penutup'],
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

    <form class="form-horizontal-feedback" action="konfirmasiulasan.php" method="post">
        <input type="hidden" name="id_info_resep" value="<?php echo $id_info_resep; ?>">
        <div class="container">
            <div class="about-card-ulasan">
                <h2>SELESAI !!</h2>
                <h7>SELAMAT MENIKMATI ^^</h7>
                <div class="container">
                    <div class="gambar-selesai">
                        <img src="../admin/image/<?php echo $ulasan_makanan[0]['gambar_penutup']; ?>" alt="Gambar Penutup" class="gambar-penutup">
                    </div>
                    <div class="about-ulasan">
                        <h8>BERIKAN ULASAN ANDA:</h8>
                        <textarea class="form-control ulasan-input" name="ulasan" id="ulasan" required></textarea>
                    </div>
                </div>
                <button type="submit" class="konfirmasi-ulasan">FINISH</button>
            </div>
        </div>
    </form>

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