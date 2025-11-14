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
$ulasan = [];

if (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];

    $sql_resep = "select nama_resep, gambar, alat, bahan, deskripsi from info_resep where id_info_resep = ?";
    $stmt_resep = mysqli_prepare($koneksi, $sql_resep);
    mysqli_stmt_bind_param($stmt_resep, "i", $id_info_resep);
    mysqli_stmt_execute($stmt_resep);
    $result_resep = mysqli_stmt_get_result($stmt_resep);
    if ($result_resep && mysqli_num_rows($result_resep) > 0) {
        $resep = mysqli_fetch_assoc($result_resep);
    }

    $sql_ulasan = "select p.nama_pengguna, u.ulasan from ulasan u left join pengguna p on u.id_pengguna = p.id_pengguna WHERE u.id_info_resep = ?";
    $stmt_ulasan = mysqli_prepare($koneksi, $sql_ulasan);
    mysqli_stmt_bind_param($stmt_ulasan, "i", $id_info_resep);
    mysqli_stmt_execute($stmt_ulasan);
    $result_ulasan = mysqli_stmt_get_result($stmt_ulasan);
    if ($result_ulasan && mysqli_num_rows($result_ulasan) > 0) {
        while ($row = mysqli_fetch_assoc($result_ulasan)) {
            $ulasan[] = $row;
        }
    }
}
?>


<!DOCTYPE html>

<head>
    <?php include("includes/head.php") ?>
    <title>Media Sosial - MasaKin</title>
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

    <?php if ($resep) { ?>
        <div class="container">
            <div class="about-menu-mami">
                <h2><?php echo $resep['nama_resep']; ?></h2>
                <div class="about-content">
                    <div class="about-mami">
                        <img src="../admin/image/<?php echo $resep['gambar']; ?>">
                    </div>
                    <div class="about-mami">
                        <div class="label-alatbahan">
                            <h6>BAHAN-BAHAN</h6>
                        </div>
                        <div class="label-isi-mami">
                            <?php echo nl2br($resep['bahan']); ?>
                        </div>
                    </div>
                    <div class="about-mami">
                        <div class="label-alatbahan">
                            <h6>ALAT-ALAT</h6>
                        </div>
                        <div class="label-isi-mami">
                            <?php echo nl2br($resep['alat']); ?>
                        </div>
                    </div>
                </div>
                <div class="about-content">
                    <div class="about-info">
                        <div class="label-alatbahan">
                            <h6 style="text-align: center;">DESKRIPSI</h6>
                        </div>
                        <div class="label-isi-mami">
                            <?php echo $resep['deskripsi']; ?>
                        </div>
                    </div>
                </div>
                <div class="tombolmulai">
                    <a class="buttonmami" href="langkah.php?id=<?php echo $id_info_resep; ?>">START</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <div class="about-menu-mami">
            <h2>ULASAN</h2>
            <?php if (!empty($ulasan)) { ?>
                <?php foreach ($ulasan as $u) { ?>
                    <div class="card-ulasan">
                        <div class="kelola-fb-all">
                            <label class="pengirim-fb"><?php echo $u['nama_pengguna']; ?></label>
                        </div>
                        <div>
                            <div class="isi-ulasan"><?php echo $u['ulasan']; ?></div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <h5>Belum ada ulasan untuk resep ini.</h5>
            <?php } ?>
        </div>
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